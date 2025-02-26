<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import AppLayout from '@/layouts/AppLayout.vue';
import Input from '@/components/ui/input/Input.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import Button from '@/components/ui/button/Button.vue';
import { type BreadcrumbItem } from '@/types';
import { Select, SelectItem, SelectValue, SelectLabel,  SelectTrigger,  SelectContent } from '@/components/ui/select';
import {Head} from '@inertiajs/vue3';

const props = defineProps<{
  clothing: { id: number; name: string; price: number; description: string; quantity: number; category_id: number };
  categories: { id: number; name: string }[];
}>();

const form = useForm({
  name: props.clothing.name,
  price: props.clothing.price,
  description: props.clothing.description,
  quantity: props.clothing.quantity,
  category_id: props.clothing.category_id,
});

const submit = () => {
  form.put(route('clothing.update', { id: props.clothing.id }));
};

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Clothing',
    href: '/clothing',
  },
  {
    title: 'Edit',
    href: `/clothing/${props.clothing.id}/edit`,
  },
];
</script>

<template>
  <div>
    <Head title="Edit Clothing" />
    <AppLayout :breadcrumbs="breadcrumbs">
      <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-semibold mb-6 mt-4">Edit Clothing</h1>
        <form @submit.prevent="submit" class="space-y-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <Input
              id="name"
              v-model="form.name"
              type="text"
              required
              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            />
            <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
          </div>

          <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <Input
              id="price"
              v-model="form.price"
              type="number"
              step="0.01"
              required
              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            />
            <p v-if="form.errors.price" class="mt-2 text-sm text-red-600">{{ form.errors.price }}</p>
          </div>

          <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <Textarea
              id="description"
              v-model="form.description"
              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            ></textarea>
            <p v-if="form.errors.description" class="mt-2 text-sm text-red-600">{{ form.errors.description }}</p>
          </div>

          <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>

            <Select 
              id="category" 
              v-model="form.category_id"
              required>
              <SelectTrigger>
              <SelectValue placeholder="Select Category" />
              </SelectTrigger>
              <SelectContent
              position="popper" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" >
                <SelectItem :value="category.id" v-for="category in props.categories" :key="category.id">{{ category.name }}</SelectItem>
              </SelectContent>
            </Select>
            <p v-if="form.errors.category_id" class="mt-2 text-sm text-red-600">{{ form.errors.category_id }}</p>
          </div>          

          <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <Input
              id="quantity"
              v-model="form.quantity"
              type="number"
              required
              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            />
            <p v-if="form.errors.quantity" class="mt-2 text-sm text-red-600">{{ form.errors.quantity }}</p>
          </div>

          <div class="flex justify-end">
            <Button
              type="submit"
              class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors"
              :disabled="form.processing"
            >
              <span v-if="form.processing">Updating...</span>
              <span v-else>Update</span>
            </Button>
          </div>
        </form>
      </div>
    </AppLayout>
  </div>
</template>