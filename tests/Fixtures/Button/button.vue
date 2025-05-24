<template>
    <!-- ✅ Good: Specifies type -->
    <button v-bind:type="type">Click me</button>

    <!-- ⚠️ Bad: Missing type -->
    <button>Click me</button>
</template>
  
<script setup>
    defineProps({
        type: { type: String, default: "button" },
    });
</script>
  