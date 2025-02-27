<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { ShirtIcon } from 'lucide-vue-next';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <ShirtIcon class="h-8 w-8 text-white dark:text-cyan-900" />
</template>
