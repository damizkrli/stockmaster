{% if product.quantity > 0 %}
<tr>
    <td class="text-center">{{ product.quantity }}</td>
    <td class="text-center">{{ product.brand }}</td>
    <td class="text-center">{{ product.name }}</td>
    <td class="text-center">{{ product.reference }}</td>
    <td class="text-center">{{ product.serialNumber }}</td>
    <td class="text-center">{{ product.addedAt ? product.addedAt|date('Y-m-d') }}</td>
    <td class="text-end me-0"><a class="btn btn-dark" href="{{ path('edit_product', {'id': product.id}) }}">Modifier</a>
    <td class="text-start ms-0">{{ include('product/_delete_form.html.twig') }}</td>
</tr>
{% endif %}