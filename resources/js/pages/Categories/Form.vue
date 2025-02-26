<script setup>
import { useForm } from '@inertiajs/vue3';
import Head from '@inertiajs/vue3';

const props = defineProps({ category: Object });
const form = useForm(props.category || { name: '' });
</script>

<template>
    <Head title="{{ category ? 'Edit' : 'Create' }} Category" />
  <h1 class="text-2xl font-semibold text-gray-200">{{ category ? 'Edit' : 'Create' }} Category</h1>
  <form @submit.prevent="form.post(route(category ? 'categories.update' : 'categories.store', category ? category.id : null))">
    <div class="mb-4">
      <label class="block mb-2">Category Name</label>
      <input v-model="form.name" class="form-input" />
      <p v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</p>
    </div>
    
    <button type="submit" class="btn-primary">
      {{ category ? 'Update' : 'Create' }} Category
    </button>
  </form>
</template>