<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ShirtIcon } from 'lucide-vue-next';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import VueApexCharts from 'vue3-apexcharts';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Rocket, X } from 'lucide-vue-next'
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: '/dashboard' }
];

const props = defineProps<{
  name?: string;
  quantity: number;
  total: number;
  categories: string[];
  categories_count: number;
  categoryQuantity: Record<string, number>;
  categoryTotal: Record<string, number>;
}>();
// Alert state
const showAlert = ref(true);

// Pie Chart Configuration
// Pie Chart Configuration
const pieChartOptions = {
  labels: Object.keys(props.categoryTotal),
  colors: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444'],
  legend: { position: 'bottom' }
};

const pieChartSeries = Object.values(props.categoryTotal);

// Bar Chart Configuration
const barChartOptions = {
  chart: { type: 'bar' },
  plotOptions: { bar: { borderRadius: 4 } },
  xaxis: { categories: Object.keys(props.categoryQuantity) },
  colors: ['#3B82F6']
};

const barChartSeries = [{
  name: 'Quantity',
  data: Object.values(props.categoryQuantity)
}];
</script>

<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
      <Alert class="mb-6 w-full max-w-[335px] lg:max-w-4xl" v-if="showAlert">
          <Rocket class="h-6 w-6 text-blue-500" />
          <AlertTitle class="text-xl font-bold">Welcome to Your Wardrobe Management System!</AlertTitle>
          <AlertDescription class="text-sm">
        Check out the stats below. If nothing appears, start by adding some categories and then your clothing items.
          </AlertDescription>
          <button @click="showAlert = false" class="absolute top-2 right-2 text-red-500">
        <X class="h-4 w-4" />
          </button>
      </Alert>
      <!-- Top Statistics Section -->
      <div class="grid auto-rows-min gap-6 md:grid-cols-3">
        <!-- Total Number of Clothes -->
        <Card class="border-sidebar-border/70 hover:shadow-lg transition-shadow">
          <CardHeader>
            <CardContent class="flex items-center justify-center p-6">
              <ShirtIcon class="h-8 w-8" />
              <p class="text-4xl ml-4">{{ quantity }}</p>
            </CardContent>
          </CardHeader>
          <CardFooter class="justify-center p-4">
            <CardDescription>Total number of clothes</CardDescription>
          </CardFooter>
        </Card>

        <!-- Total Value -->
        <Card class="border-sidebar-border/70 hover:shadow-lg transition-shadow">
          <CardHeader>
            <CardContent class="flex items-center justify-center p-6">
              <p class="text-4xl">${{ total.toFixed(2) }}</p>
            </CardContent>
          </CardHeader>
          <CardFooter class="justify-center p-4">
            <CardDescription>Total wardrobe value</CardDescription>
          </CardFooter>
        </Card>

        <!-- Total Categories -->
        <Card class="border-sidebar-border/70 hover:shadow-lg transition-shadow">
          <CardHeader>
            <CardContent class="flex items-center justify-center p-6">
              <p class="text-4xl">{{ categories.length }}</p>
            </CardContent>
          </CardHeader>
          <CardFooter class="justify-center p-4">
            <CardDescription>Unique categories</CardDescription>
          </CardFooter>
        </Card>
      </div>

      <!-- Charts Section -->
      <div class="grid gap-6 md:grid-cols-2">
        <!-- Pie Chart Card -->
        <Card class="border-sidebar-border/70 hover:shadow-lg transition-shadow">
          <CardHeader>
            <CardTitle class="text-center">Value Distribution</CardTitle>
          </CardHeader>
          <CardContent>
            <VueApexCharts
              type="pie"
              height="350"
              :options="pieChartOptions"
              :series="pieChartSeries"
            />
          </CardContent>
        </Card>

        <!-- Bar Chart Card -->
        <Card class="border-sidebar-border/70 hover:shadow-lg transition-shadow">
          <CardHeader>
            <CardTitle class="text-center">Quantity per Category</CardTitle>
          </CardHeader>
          <CardContent text-center class="text-slate-900">
            <VueApexCharts
              type="bar"
              height="350"
              :options="barChartOptions"
              :series="barChartSeries"
            />
          </CardContent>
        </Card>
      </div>

      <!-- Category Details Section -->
      <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <Card 
          v-for="(category, index) in categories"
          :key="index"
          class="border-sidebar-border/70 hover:shadow-lg transition-shadow"
        >
          <CardHeader>
            <CardTitle class="capitalize">{{ category }}</CardTitle>
          </CardHeader>
          <CardContent>
            <div class="space-y-2">
              <p>Items: {{ categoryQuantity[category] }}</p>
              <p>Total Value: ${{ categoryTotal[category].toFixed(2) }}</p>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  </AppLayout>
</template>