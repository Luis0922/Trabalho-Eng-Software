@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#038e83] focus:ring-[#038e83] rounded-md shadow-sm']) !!}>
</select>