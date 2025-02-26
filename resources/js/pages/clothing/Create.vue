<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import Input from '@/components/ui/input/Input.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import Button from '@/components/ui/button/Button.vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectItem, SelectValue, SelectLabel,  SelectTrigger,  SelectContent } from '@/components/ui/select';
import {Head} from '@inertiajs/vue3';

const form = useForm({
  name: '',
  price: 0,
  description: '',
  quantity: 0,
  category: '',
});

const submit = () => {
  form.post(route('clothing.store'));
};

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Clothing',
    href: '/clothing',
  },
  {
    title: 'Create',
    href: '/clothing/create',
  },
];
</script>

<template>
  <div>
    <Head title="Create Clothing" />
    <AppLayout :breadcrumbs="breadcrumbs">
      <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-semibold mb-6">Create New Clothing</h1>
        <form @submit.prevent="submit" class="space-y-6">
          <div>
            <Label for="name" class="block text-sm font-medium text-gray-700">Name</Label>
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
            <Label for="price" class="block text-sm font-medium text-gray-700">Price</Label>
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
            <Label for="description" class="block text-sm font-medium text-gray-700">Description</Label>
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
                v-model="form.category"
                required>
              <SelectTrigger>
                <SelectValue placeholder="Select" />
              </SelectTrigger>
              <SelectContent
                position="popper" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" >
                  <SelectItem value="tops">Tops</SelectItem>
                  <SelectItem value="bottoms">Bottoms</SelectItem>
                  <SelectItem value="shoes">Shoes</SelectItem>
                </SelectContent>
            </Select>
            <p v-if="form.errors.category" class="mt-2 text-sm text-red-600">{{ form.errors.category }}</p>
          </div>

          <div>
            <Label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</Label>
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
              <span v-if="form.processing">Creating...</span>
              <span v-else>Create</span>
            </Button>
          </div>
        </form>
      </div>
    </AppLayout>
  </div>
</template>