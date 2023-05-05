{% if product.quantity < 2 or product.quantity == 0 %}
<tr>
    <td class="text-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="2.5" stroke="red" class="w-6 h-6 svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
        </svg>
    </td>
    <td class="text-center">{{ product.quantity }}</td>
    <td class="text-center">{{ product.brand|capitalize }}</td>
    <td class="text-center">{{ product.name }}</td>
    <td class="text-center">{{ product.reference }}</td>
    <td class="text-center">{{ product.serialNumber }}</td>
    <td class="text-center">{{ product.addedAt ? product.addedAt|date('Y-m-d') }}</td>
</tr>
{% endif %}