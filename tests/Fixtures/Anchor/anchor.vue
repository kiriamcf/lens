<template>
    <!-- ✅ Good: Has both href and target -->
    <a :href="url" :target="target">Valid Anchor</a>
  
    <!-- ❌ Bad: Missing href -->
    <a :target="target">Missing Href</a>

    <!-- ⚠️ Bad: Missing target -->
    <a :href="url">Missing Target</a>
  
    <!-- ❌ Bad: No attributes -->
    <a>No Attributes</a>
</template>
  
<script setup>
    defineProps({
        url: { type: String, default: "https://example.com" },
        target: { type: String, default: "_blank" }
    });
</script>
  