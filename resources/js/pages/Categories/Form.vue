<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import Input from '@/components/ui/input/Input.vue';
import Button from '@/components/ui/button/Button.vue';

const props = defineProps({
    category: {
        type: Object,
        default: () => ({ name: '' }),
    },
});

const form = useForm({
    name: props.category.name,
});

const submit = () => {
    if (props.category.id) {
        form.put(route('categories.update', props.category.id));
    } else {
        form.post(route('categories.store'));
    }
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categories',
        href: '/categories',
    },
    {
        title: props.category.id ? 'Edit Category' : 'Create Category',
        href: '/categories',
    },
];
</script>

<template>
    <Head :title="category.id ? 'Edit Category' : 'Create Category'" />
    
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-4">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-500 pl-5 pt-3">
                {{ category.id ? 'Edit' : 'Create' }} Category
            </h1>
        </div>
        
        <div class="container mx-auto p-4 max-w-lg">
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="categoryname" class="block mb-2">Category Name</label>
                    <Input v-model="form.name" id="name" class="form-input" />
                    <p v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</p>
                </div>
                <Button type="submit" class="btn-primary">
                    {{ category.id ? 'Update' : 'Create' }} Category
                </Button>
                <a :href="route('categories.index')" class="bg-red-600 m-3 text-white py-2 px-4 rounded">Cancel</a>
            </form>
        </div>
     </AppLayout>
</template>

