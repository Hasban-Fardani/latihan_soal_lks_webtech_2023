<script setup>
defineProps({
    label: String,
    name: String,
    cols: Number,
    rows: Number
})

</script>
<template>
    <div class="form-group mb-3">
        <label :for="name" class="mb-1 text-muted">{{ label }}</label>
        <textarea :name="name" :id="name" :cols="cols" :rows="rows" class="form-control"></textarea>
    </div>
</template>