<template>
  <AdminLayout :allCriteria="allCriteria" :activeCriteriaId="criteria.id">
    <Head :title="`แก้ไข AUN ${criteria.number}`" />

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-6 text-sm text-gray-400">
      <Link :href="route('admin.criteria.index')" class="transition-colors hover:text-primary-500">
        จัดการ AUN-QA
      </Link>
      <span>/</span>
      <span class="font-medium text-gray-700">แก้ไข AUN {{ criteria.number }}</span>
    </div>

    <div class="max-w-2xl">
      <h1 class="mb-6 text-lg font-semibold text-gray-900">แก้ไข AUN {{ criteria.number }}</h1>

      <form @submit.prevent="submit" class="space-y-5">

        <!-- Number (read-only) -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">หมายเลข</label>
          <input type="text" :value="`AUN ${criteria.number}`" disabled
                 class="w-full px-3 py-2 text-sm text-gray-400 border border-gray-200 rounded-lg cursor-not-allowed bg-gray-50" />
        </div>

        <!-- Title -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            ชื่อหัวข้อ <span class="text-red-400">*</span>
          </label>
          <input v-model="form.title" type="text" required
                 class="w-full px-3 py-2 text-sm transition border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400"
                 placeholder="เช่น Expected Learning Outcomes" />
          <p v-if="form.errors.title" class="mt-1 text-xs text-red-500">{{ form.errors.title }}</p>
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">คำอธิบาย (optional)</label>
          <textarea v-model="form.description" rows="3"
                    class="w-full px-3 py-2 text-sm transition border border-gray-200 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400"
                    placeholder="คำอธิบายเพิ่มเติมสำหรับ AUN นี้..." />
          <p v-if="form.errors.description" class="mt-1 text-xs text-red-500">{{ form.errors.description }}</p>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3 pt-2">
          <button type="submit" :disabled="form.processing"
                  class="px-6 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-500 hover:bg-primary-600 disabled:opacity-50">
            {{ form.processing ? 'กำลังบันทึก...' : 'บันทึก' }}
          </button>
          <Link :href="route('admin.criteria.index')"
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
  criteria:    Object,
  allCriteria: Array,
})

const form = useForm({
  title:       props.criteria.title,
  description: props.criteria.description || '',
})

function submit() {
  form.put(route('admin.criteria.update', props.criteria.id))
}
</script>