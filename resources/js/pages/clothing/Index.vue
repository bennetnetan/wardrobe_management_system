<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Table, TableBody, TableCaption, TableCell, TableEmpty, TableFooter, TableHead, TableHeader, TableRow } from '@/components/ui/table/';

defineProps<{
    name?: string,
    clothing?: Array<{ id: number, name: string, price: number, description: string, quantity: number }>,
}>();

const editItem = (id: number) => {
  router.visit(route('clothing.edit', { id }));
};

const deleteItem = (id: number) => {
  if (confirm('Are you sure you want to delete this item?')) {
    router.delete(route('clothing.destroy', { id }));
  }
};

const createItem = () => {
  router.visit(route('clothing.create'));
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Clothing',
        href: '/clothing',
    },
];
</script>

<template>
  <div>
    <Head title="Clothing" />
    <AppLayout :breadcrumbs="breadcrumbs">
      <div class="flex justify-end mb-4">
        <button @click="createItem" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
          Create New
        </button>
        <!-- <Link
          :href="route('clothing.create')"
          class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
        >
          Create
        </Link> -->
        <!-- <Link
            :href="route('clothing.create')"
            class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
        >
            Log in
        </Link> -->
      </div>

      <div class="overflow-x-auto">
        <Table class="w-full">
          <TableCaption class="text-lg font-semibold mb-4">Clothing List</TableCaption>
          <TableHeader class="bg-blue-800">
            <TableRow>
              <TableHead class="px-4 py-2 text-left">Name</TableHead>
              <TableHead class="px-4 py-2 text-left">Price</TableHead>
              <TableHead class="px-4 py-2 text-left">Description</TableHead>
              <TableHead class="px-4 py-2 text-left">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow v-for="item in clothing" :key="item.id" class="hover:bg-gray-700 transition-colors">
              <TableCell class="px-4 py-2">{{ item.name }}</TableCell>
              <TableCell class="px-4 py-2">${{ item.price.toFixed(2) }}</TableCell>
              <TableCell class="px-4 py-2">{{ item.description }}</TableCell>
              <TableCell class="px-4 py-2">
                <button @click="editItem(item.id)" class="text-blue-500 hover:text-blue-700 mr-2">Edit</button>
                <button @click="deleteItem(item.id)" class="text-red-500 hover:text-red-700">Delete</button>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>

      <template v-if="!clothing || !clothing.length">
        <TableEmpty class="text-center py-8 text-gray-500">No clothing items found.</TableEmpty>
      </template>
    </AppLayout>
  </div>
</template>