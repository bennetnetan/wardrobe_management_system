<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Table, TableBody, TableHead, TableHeader, TableRow, TableCell, TableEmpty } from '@/components/ui/table/';
import { ref, computed } from 'vue';
import { Input } from '@/components/ui/input';
import { Plus, X, Search } from 'lucide-vue-next';
import Button from '@/components/ui/button/Button.vue';

const props = defineProps<{
    categories: Array<{ id: number, name: string }>,
}>();

const searchTerm = ref('');

const filteredCategories = computed(() => {
    return props.categories.filter(category => 
        category.name.toLowerCase().includes(searchTerm.value.toLowerCase())
    );
});

const editCategory = (id: number) => {
  router.visit(route('categories.edit', { id }));
};

const deleteCategory = (id: number) => {
  if (confirm('Are you sure you want to delete this category?')) {
    router.delete(route('categories.destroy', { id }));
  }
};

const createCategory = () => {
  router.visit(route('categories.create'));
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categories',
        href: '/categories',
    }
];
</script>

<template>
  <div>
    <Head title="Categories" />
    <AppLayout :breadcrumbs="breadcrumbs">
      <div class="mb-4">
        <Button 
          @click="createCategory" 
          class="float-right bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors flex items-center gap-2"
        >
          <Plus class="h-4 w-4" /> Create Category
        </Button> 
        <h1 class="text-2xl font-semibold text-gray-200 pl-5 pt-3">Categories</h1>
      </div>

      <!-- Search Bar -->
      <div class="flex flex-col sm:flex-row gap-3 mb-6 px-4">
        <div class="relative flex-1 max-w-md">
          <Input 
            v-model="searchTerm"
            placeholder="Search categories..."
            class="pl-10"
          />
          <Search class="absolute left-3 top-3 h-4 w-4 text-gray-400" />
        </div>
        <Button 
          @click="searchTerm = ''" 
          class="h-10 px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors"
          title="Clear search"
        >
          <X class="h-4 w-4" />
        </Button>
      </div>

      <!-- Data Table -->
      <div class="rounded-lg border border-gray-500 overflow-hidden">
        <Table class="w-full">
          <TableHeader class="bg-gray-900 text-gray-700">
            <TableRow>
              <TableHead class="px-4 py-3">Name</TableHead>
              <TableHead class="px-4 py-3 w-32">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow 
              v-for="category in filteredCategories" 
              :key="category.id"
              class="hover:bg-gray-800 transition-colors"
            >
              <TableCell class="px-4 py-3 font-medium">{{ category.name }}</TableCell>
              <TableCell class="px-4 py-3">
                <div class="flex gap-3">
                  <button 
                    @click="editCategory(category.id)"
                    class="text-blue-600 hover:text-blue-800 transition-colors"
                  >
                    Edit
                  </button>
                  <button 
                    @click="deleteCategory(category.id)"
                    class="text-red-600 hover:text-red-800 transition-colors"
                  >
                    Delete
                  </button>
                </div>
              </TableCell>
            </TableRow>
          </TableBody>
        </Table>

        <TableEmpty 
          v-if="!filteredCategories.length" 
          class="py-8 text-gray-500 text-center"
        >
          No categories found matching your criteria
        </TableEmpty>
      </div>
    </AppLayout>
  </div>
</template>