<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Table, TableBody, TableCell, TableEmpty, TableHead, TableHeader, TableRow } from '@/components/ui/table/';
import { ref, computed } from 'vue';
import { Select, SelectItem, SelectValue, SelectTrigger, SelectContent } from '@/components/ui/select';
import { Input } from '@/components/ui/input';
import { Plus, X, Search } from 'lucide-vue-next';
import Button from '@/components/ui/button/Button.vue';

const props = defineProps<{
    name?: string,
    clothing?: Array<{ id: number, name: string, price: number, description: string, quantity: number; category_id: number }>,
    categories?: Array<{ id: number, name: string }>,
}>();

const searchTerm = ref('');
const selectedCategory = ref('');

const filteredClothing = computed(() => {
    return (Array.isArray(props.clothing) ? props.clothing : []).filter(item => {
      const matchesSearch = item.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
                item.description.toLowerCase().includes(searchTerm.value.toLowerCase());
      const matchesCategory = !selectedCategory.value || item.category_id === Number(selectedCategory.value);
      return matchesSearch && matchesCategory;
    }).map(item => {
      const category = props.categories?.find(cat => cat.id === item.category_id);
      return {
        ...item,
        category: category ? category.name : 'Unknown'
      };
    });
});

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
        title: 'Clothing',
        href: '/clothing',
    }
];
</script>


<template>
  <div>
    <Head title="Clothing" />
    <AppLayout :breadcrumbs="breadcrumbs">
      <div class="mb-4">
        <Button 
          @click="createItem" 
          class="float-right bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors flex items-center gap-2"
        >
          <Plus class="h-4 w-4" /> Add Item
        </Button> 
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 pl-5 pt-3">Clothing Inventory</h1>
      </div>

      <!-- Filter/Search Bar -->
      <div class="flex flex-col sm:flex-row gap-3 mb-6 px-4">
        <div class="relative flex-1 max-w-md">
          <Input 
            v-model="searchTerm"
            placeholder="Search items..."
            class="pl-10"
          />
          <Search class="absolute left-3 top-3 h-4 w-4 text-gray-400" />
        </div>

        <div class="flex gap-2 items-center">
          <Select v-model="selectedCategory" class="w-48">
            <SelectTrigger>
              <SelectValue placeholder="Filter by Category" />
            </SelectTrigger>
            <SelectContent
            position="popper" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" >
              <SelectItem :value="category.id" v-for="category in categories">{{ category.name }}</SelectItem>  
            </SelectContent>
          </Select>
          
          <Button 
            @click="selectedCategory = ''; searchTerm = ''" 
            class="h-10 px-3 py-2 bg-gray-900 dark:bg-slate-300 hover:bg-gray-600 rounded-md transition-colors"
            title="Clear filters"
          >
            <X class="h-4 w-4" />
          </Button>
        </div>
      </div>

      <!-- Data Table -->
      <div class="rounded-lg border border-gray-500 overflow-hidden">
        <Table class="w-full">
          <TableHeader class="bg-gray-900 text-gray-700">
            <TableRow>
              <TableHead class="px-4 py-3">Name</TableHead>
              <TableHead class="px-4 py-3">Price</TableHead>
              <TableHead class="px-4 py-3">Quantity</TableHead>
              <TableHead class="px-4 py-3">Description</TableHead>
              <TableHead class="px-4 py-3">Category</TableHead>
              <TableHead class="px-4 py-3 w-32">Actions</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            <TableRow 
              v-for="item in filteredClothing" 
              :key="item.id"
              class="hover:bg-gray-800 transition-colors"
            >
              <TableCell class="px-4 py-3 font-medium">{{ item.name }}</TableCell>
              <TableCell class="px-4 py-3">${{ item.price.toFixed(2) }}</TableCell>
              <TableCell class="px-4 py-3">
                <span class="px-2 py-1 rounded-full bg-blue-200 text-blue-800 text-sm">
                  {{ item.quantity }}
                </span>
              </TableCell>
              <TableCell class="px-4 py-3 text-gray-200 max-w-[300px] truncate">
                {{ item.description }}
              </TableCell>
              <TableCell class="px-4 py-3">
                <span class="capitalize px-3 py-1 rounded-full text-sm"
                      :class="{
                        'bg-purple-400 text-purple-800': item.category === 'tops',
                        'bg-green-400 text-green-800': item.category === 'bottoms',
                        'bg-orange-400 text-orange-800': item.category === 'shoes'
                      }">
                  {{ item.category }}
                </span>
              </TableCell>
              <TableCell class="px-4 py-3">
                <div class="flex gap-3">
                  <button 
                    @click="editItem(item.id)"
                    class="text-blue-600 hover:text-blue-800 transition-colors"
                  >
                    Edit
                  </button>
                  <button 
                    @click="deleteItem(item.id)"
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
          v-if="!filteredClothing.length" 
          class="py-8 text-gray-500 text-center"
        >
          No items found matching your criteria
        </TableEmpty>
      </div>
    </AppLayout>
  </div>
</template>