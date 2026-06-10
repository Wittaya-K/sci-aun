<template>
  <AdminLayout :allCriteria="allCriteria" :activeCriteriaId="criteria.id">
    <Head :title="subCriteria ? `แก้ไข ${subCriteria.number}` : 'เพิ่ม Sub-criteria'" />

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-6 text-sm text-gray-400">
      <Link :href="route('admin.criteria.index')" class="transition-colors hover:text-primary-500">
        จัดการ AUN-QA
      </Link>
      <span>/</span>
      <Link :href="route('admin.criteria.sub-criteria.index', criteria.id)"
            class="transition-colors hover:text-primary-500">
        AUN {{ criteria.number }}
      </Link>
      <span>/</span>
      <span class="font-medium text-gray-700">{{ subCriteria ? `แก้ไข ${subCriteria.number}` : 'เพิ่ม Sub-criteria' }}</span>
    </div>

    <div class="max-w-2xl">
      <h1 class="mb-6 text-lg font-semibold text-gray-900">
        {{ subCriteria ? `แก้ไข ${subCriteria.number}` : `เพิ่ม Sub-criteria ใน AUN ${criteria.number}` }}
      </h1>

      <form @submit.prevent="submit" class="space-y-5">

        <!-- Number -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            หมายเลข <span class="text-red-400">*</span>
          </label>
          <input v-model="form.number" type="text" required
                 :disabled="!!subCriteria"
                 class="w-full px-3 py-2 text-sm transition border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400"
                 :class="subCriteria ? 'bg-gray-50 text-gray-400 cursor-not-allowed' : ''"
                 :placeholder="`เช่น ${criteria.number}.1`" />
          <p v-if="form.errors.number" class="mt-1 text-xs text-red-500">{{ form.errors.number }}</p>
        </div>

        <!-- Title -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">
            ชื่อหัวข้อย่อย <span class="text-red-400">*</span>
          </label>
          <textarea v-model="form.title" rows="4" required
                    class="w-full px-3 py-2 text-sm transition border border-gray-200 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400"
                    placeholder="The programme to show that..." />
          <p v-if="form.errors.title" class="mt-1 text-xs text-red-500">{{ form.errors.title }}</p>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3 pt-2">
          <button type="submit" :disabled="form.processing"
                  class="px-6 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-500 hover:bg-primary-600 disabled:opacity-50">
            {{ form.processing ? 'กำลังบันทึก...' : 'บันทึก' }}
          </button>
          <Link :href="route('admin.criteria.sub-criteria.index', criteria.id)"
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
  subCriteria: Object, // null = create mode
  allCriteria: Array,
})

const form = useForm({
  number: props.subCriteria?.number || '',
  title:  props.subCriteria?.title  || '',
})

function submit() {
  if (props.subCriteria) {
    form.put(route('admin.criteria.sub-criteria.update', [
      props.criteria.id, props.subCriteria.id,
    ]))
  } else {
    form.post(route('admin.criteria.sub-criteria.store', props.criteria.id))
  }
}
</script>