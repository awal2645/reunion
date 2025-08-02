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
                'users.full_name',
                'users.contact_number',
                'users.email',
                'orders.trxid',
                'orders.status',
                'orders.amount',
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

        return $query->orderByDesc('orders.created_at')->get();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Customer Name',
            'Phone',
            'Email',
            'Transaction ID',
            'Status',
            'Amount',
            'Created At',
        ];
    }
}
