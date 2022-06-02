<template>
    <tr class="bg-brand-primary text-sm leading-normal">
        <th class="px-2 py-4 text-right bg-gray-200 uppercase align-top">
            {{ heading }}
        </th>
        <td class="px-2 py-4 text-left bg-white">
            <slot />
        </td>
    </tr>
</template>

<script>
export default {
    props: {
        heading: { type: String, default: "" },
    },
};
</script>
