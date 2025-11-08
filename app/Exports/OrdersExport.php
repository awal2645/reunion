<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Order::query()
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'orders.id',
                'users.session',
                'users.courses_completed',
                'users.full_name',
                'users.contact_number',
                'users.email',
                'orders.trxid',
                'orders.status',
                'orders.amount',
                'users.accompanying_guests',
                'orders.guest_details',
                'users.tshirt_size',
                'orders.created_at'
            );

        if (!empty($this->filters['status'])) {
            $query->where('orders.status', $this->filters['status']);
        }
        if (!empty($this->filters['phone'])) {
            $query->where('users.contact_number', 'like', '%' . $this->filters['phone'] . '%');
        }
        if (!empty($this->filters['email'])) {
            $query->where('users.email', 'like', '%' . $this->filters['email'] . '%');
        }
        if (!empty($this->filters['trxid'])) {
            $query->where('orders.trxid', 'like', '%' . $this->filters['trxid'] . '%');
        }

        return $query->orderByDesc('orders.created_at')->get()->map(function ($order) {
            $courseLabel = match ($order->courses_completed) {
                'bsc' => 'BSc',
                'msc' => 'MSc',
                'both' => 'BSc & MSc',
                default => 'N/A',
            };

            $guestDetails = is_array($order->guest_details) ? $order->guest_details : [];

            $guestNames = collect($guestDetails)
                ->pluck('name')
                ->filter()
                ->implode(', ');

            $guestDataFormatted = collect($guestDetails)
                ->map(function ($guest) {
                    $name = $guest['name'] ?? 'N/A';
                    $age = $guest['age'] ?? null;
                    $relation = $guest['relation'] ?? null;

                    $segments = ["Name: {$name}"];
                    if (!is_null($relation) && $relation !== '') {
                        $segments[] = "Relation: {$relation}";
                    }
                    if (!is_null($age) && $age !== '') {
                        $segments[] = "Age: {$age}";
                    }

                    return implode(' | ', $segments);
                })
                ->implode('; ');

            $guestCount = count($guestDetails);
            if ($guestCount === 0 && !is_null($order->accompanying_guests)) {
                $guestCount = (int) $order->accompanying_guests;
            }

            return [
                'Order ID' => $order->id,
                'Session' => $order->session,
                'Courses Completed' => $courseLabel,
                'Customer Name' => $order->full_name,
                'Phone' => $order->contact_number,
                'Email' => $order->email,
                'Transaction ID' => $order->trxid,
                'Status' => ucfirst($order->status),
                'Amount' => $order->amount,
                'Number of Accompanying Guests' => $guestCount,
                'Guest Details' => $guestDataFormatted ?: 'N/A',
                'T-shirt Size' => strtoupper($order->tshirt_size ?? 'N/A'),
                'Created At' => optional($order->created_at)->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Session',
            'Courses Completed',
            'Customer Name',
            'Phone',
            'Email',
            'Transaction ID',
            'Status',
            'Amount',
            'Number of Accompanying Guests',
            'Guest Details',
            'T-shirt Size',
            'Created At',
        ];
    }
}
