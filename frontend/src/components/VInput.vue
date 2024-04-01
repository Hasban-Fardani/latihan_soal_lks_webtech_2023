<script setup>
defineProps({
    label: String,
    name: String,
    type: String,
    autofocus: Boolean
})

</script>
<template>
    <div class="form-group mb-3">
        <label :for="name" class="mb-1 text-muted">{{ label }}</label>
        <input :type="type" :id="name" :name="name" class="form-control" :autofocus="autofocus" />
    </div>
</template>