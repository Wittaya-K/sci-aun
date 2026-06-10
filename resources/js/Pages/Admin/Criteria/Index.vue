<template>
  <AdminLayout :allCriteria="allCriteria" :activeCriteriaId="null">
    <Head title="จัดการ AUN-QA" />

    <div class="flex items-center justify-between mb-6">
      <h1 class="text-lg font-semibold text-gray-900">จัดการ AUN-QA Criteria</h1>
    </div>

    <div class="space-y-2">
      <div v-for="c in allCriteria" :key="c.id"
           class="flex items-center justify-between gap-4 px-4 py-3 bg-white border border-gray-200 rounded-lg">
        <div class="flex items-center flex-1 min-w-0 gap-3">
          <span class="text-xs font-semibold text-primary-500 bg-primary-50 px-2 py-0.5 rounded whitespace-nowrap">
            AUN {{ c.number }}
          </span>
          <span class="text-sm text-gray-700 truncate">{{ c.title }}</span>
        </div>
        <div class="flex items-center flex-shrink-0 gap-2">
          <Link :href="route('admin.criteria.edit', c.id)"
                class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition-colors">
            แก้ไขชื่อ
          </Link>
          <Link :href="route('admin.criteria.sub-criteria.index', c.id)"
                class="text-xs px-3 py-1.5 bg-primary-50 text-primary-600 rounded hover:bg-primary-100 transition-colors font-medium">
            จัดการ Items →
          </Link>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({
  allCriteria: Array,
})
</script>
