<template>
  <AdminLayout :allCriteria="allCriteria" :activeCriteriaId="null">
    <Head :title="user ? 'แก้ไขผู้ใช้' : 'เพิ่มผู้ใช้'" />

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-6 text-sm text-gray-400">
      <Link :href="route('admin.users.index')" class="transition-colors hover:text-primary-500">
        จัดการผู้ใช้
      </Link>
      <span>/</span>
      <span class="font-medium text-gray-700">{{ user ? 'แก้ไข' : 'เพิ่มผู้ใช้' }}</span>
    </div>

    <div class="max-w-md">
      <h1 class="mb-6 text-lg font-semibold text-gray-900">
        {{ user ? `แก้ไข · ${user.name}` : 'เพิ่มผู้ใช้ใหม่' }}
      </h1>

      <form @submit.prevent="submit" class="space-y-5">

        <!-- Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            ชื่อ <span class="text-red-400">*</span>
          </label>
          <input v-model="form.name" type="text" required
                 class="w-full px-3 py-2 text-sm transition border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400"
                 placeholder="ชื่อผู้ใช้" />
          <p v-if="form.errors.name" class="mt-1 text-xs text-red-500">{{ form.errors.name }}</p>
        </div>

        <!-- Email -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            Email <span class="text-red-400">*</span>
          </label>
          <input v-model="form.email" type="email" required
                 class="w-full px-3 py-2 text-sm transition border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400"
                 placeholder="email@example.com" />
          <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">{{ form.errors.email }}</p>
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            รหัสผ่าน
            <span v-if="user" class="text-xs font-normal text-gray-400">(เว้นว่างไว้ถ้าไม่ต้องการเปลี่ยน)</span>
            <span v-else class="text-red-400">*</span>
          </label>
          <input v-model="form.password" type="password"
                 :required="!user"
                 class="w-full px-3 py-2 text-sm transition border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400"
                 placeholder="อย่างน้อย 8 ตัวอักษร" />
          <p v-if="form.errors.password" class="mt-1 text-xs text-red-500">{{ form.errors.password }}</p>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3 pt-2">
          <button type="submit" :disabled="form.processing"
                  class="px-6 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-500 hover:bg-primary-600 disabled:opacity-50">
            {{ form.processing ? 'กำลังบันทึก...' : 'บันทึก' }}
          </button>
          <Link :href="route('admin.users.index')"
                class="px-4 py-2 text-sm text-gray-600 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
            ยกเลิก
          </Link>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
  user:        Object, // null = create mode
  allCriteria: Array,
})

const form = useForm({
  name:     props.user?.name  || '',
  email:    props.user?.email || '',
  password: '',
})

function submit() {
  if (props.user) {
    form.put(route('admin.users.update', props.user.id))
  } else {
    form.post(route('admin.users.store'))
  }
}
</script>
