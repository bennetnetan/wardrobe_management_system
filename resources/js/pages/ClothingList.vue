<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Card, CardTitle, CardContent, CardDescription, CardFooter } from '@/components/ui/card/';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import Label from '@/components/ui/label/Label.vue';
import route from 'ziggy-js';

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

defineProps<{
    name?: string;
}>();

import { reactive } from 'vue';

const form = reactive({
    name: '',
    description: '',
    price: 0,
    quantity: 0,
});

const createClothing = () => {
    
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });

    console.log('Form submitted', form);
};


</script>

<template>
    <Head title="Clothing" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div>
              <h1>Clothing List</h1>
              <ul>
                <li v-for="item in clothing" :key="item.id">
                  {{ item.name }} - {{ item.price }}
                  <button @click="editItem(item.id)">Edit</button>
                  <button @click="deleteItem(item.id)">Delete</button>
                </li>
              </ul>
              <button @click="createItem">Create New</button>
            </div>
            <!-- <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min"> -->
                <Card class="text-center m-6 p-5">
                    <CardTitle class="mb-5">Clothing</CardTitle>
                    <CardContent>
                        <form @submit.prevent="createClothing" class="flex flex-col gap-6">
                          <div>
                            <Label for="name">Name</Label>
                            <Input v-model="form.name" type="text" name="name" id="name" placeholder="Name" class="w-full mt-1" required />
                          </div>
                          <div>
                            <Label for="description">Description</Label>
                            <Textarea v-model="form.description" name="description" id="description" placeholder="Description" class="w-full mt-1"></Textarea>
                          </div>
                          <div>
                            <Label for="price">Price</Label>
                            <Input v-model="form.price" type="number" name="price" id="price" placeholder="Price" class="w-full mt-1" required />
                          </div>
                          <div>
                            <Label for="quantity">Quantity</Label>
                            <Input v-model="form.quantity" type="number" name="quantity" id="quantity" placeholder="Quantity" class="w-full mt-1" required />
                          </div>
                          <div class="flex justify-end">
                            <Button type="submit">Create</Button>
                          </div>
                        </form>
                        <CardDescription>
                            Here you can manage your clothing items.
                        </CardDescription>
                    </CardContent>
                </Card>
            <!-- </div> -->
        </div>
    </AppLayout>
</template>
