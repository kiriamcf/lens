<template>
    <!-- ✅ Good: Specifies action, method and enctype -->
    <form v-bind:action="action" v-bind:method="method" v-bind:enctype="enctype">...</form>

    <!-- ❌ Bad: Missing action -->
    <form v-bind:method="method" v-bind:enctype="enctype">...</form>

    <!-- ⚠️ Bad: Missing method -->
    <form v-bind:action="action" v-bind:enctype="enctype">...</form>

    <!-- ⚠️ Bad: Missing enctype -->
    <form v-bind:action="action" v-bind:method="method">...</form>

    <!-- ❌ Bad: No attributes -->
    <form></form>
</template>
  
<script setup>
    defineProps({
        action: { type: String, default: "#" },
        method: { type: String, default: "POST" },
        enctype: { type: String, default: "application/x-www-form-urlencoded" },
    });
</script>
  