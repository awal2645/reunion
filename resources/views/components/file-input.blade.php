@props(['disabled' => false, 'name', 'id', 'accept' => 'image/*'])

<input type="file" 
       name="{{ $name }}" 
       id="{{ $id }}" 
       accept="{{ $accept }}"
       {{ $disabled ? 'disabled' : '' }}
       {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
