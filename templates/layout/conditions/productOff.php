{% if product.quantity > 0 %}
<tr>
    <td class="text-center">{{ product.quantity }}</td>
    <td class="text-center">{{ product.brand|capitalize }}</td>
    <td class="text-center">{{ product.name }}</td>
    <td class="text-center">{{ product.reference }}</td>
    <td class="text-center">{{ product.serialNumber }}</td>
    <td class="text-center">{{ product.addedAt ? product.addedAt|date('Y-m-d') }}</td>
</tr>
{% endif %}