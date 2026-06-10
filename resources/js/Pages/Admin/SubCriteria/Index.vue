<template>
  <AdminLayout :allCriteria="allCriteria" :activeCriteriaId="criteria.id">
    <Head :title="`AUN ${criteria.number} · Sub-criteria`" />

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-6 text-sm text-gray-400">
      <Link :href="route('admin.criteria.index')" class="transition-colors hover:text-primary-500">
        จัดการ AUN-QA
      </Link>
      <span>/</span>
      <span class="font-medium text-gray-700">AUN {{ criteria.number }} · {{ criteria.title }}</span>
    </div>

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-lg font-semibold text-gray-900">AUN {{ criteria.number }}</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ criteria.title }}</p>
      </div>
      <Link :href="route('admin.criteria.sub-criteria.create', criteria.id)"
            class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-500 hover:bg-primary-600">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        เพิ่ม Sub-criteria
      </Link>
    </div>

    <!-- List -->
    <div v-if="subCriteria.length > 0" class="space-y-2">
      <div v-for="sub in subCriteria" :key="sub.id"
           class="flex items-center justify-between gap-4 px-4 py-3 bg-white border border-gray-200 rounded-lg">
        <div class="flex items-center flex-1 min-w-0 gap-3">
          <span class="text-xs font-semibold text-primary-500 bg-primary-50 px-2 py-0.5 rounded whitespace-nowrap">
            {{ sub.number }}
          </span>
          <span class="text-sm leading-snug text-gray-700 line-clamp-2">{{ sub.title }}</span>
        </div>
        <div class="flex items-center flex-shrink-0 gap-2">
          <span class="text-xs text-gray-400 whitespace-nowrap">{{ sub.items_count }} items</span>
          <Link :href="route('admin.criteria.sub-criteria.edit', [criteria.id, sub.id])"
                class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition-colors whitespace-nowrap">
            แก้ไขชื่อ
          </Link>
          <Link :href="route('admin.criteria.sub-criteria.items.index', [criteria.id, sub.id])"
                class="text-xs px-3 py-1.5 bg-primary-50 text-primary-600 rounded hover:bg-primary-100 transition-colors font-medium whitespace-nowrap">
            จัดการ Items →
          </Link>
          <button type="button" @click="confirmDelete(sub)"
                  class="text-xs px-3 py-1.5 bg-red-50 text-red-500 rounded hover:bg-red-100 transition-colors whitespace-nowrap">
            ลบ
          </button>
        </div>
      </div>
    </div>

    <!-- Empty -->
    <div v-else class="py-16 text-center bg-white border border-gray-200 border-dashed rounded-lg">
      <p class="mb-3 text-sm text-gray-400">ยังไม่มี Sub-criteria</p>
      <Link :href="route('admin.criteria.sub-criteria.create', criteria.id)"
            class="text-sm font-medium text-primary-500 hover:text-primary-600">
        + เพิ่ม Sub-criteria แรก
      </Link>
    </div>

    <!-- Delete modal -->
    <div v-if="deleteTarget" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
         @click.self="deleteTarget = null">
      <div class="w-full max-w-sm p-6 mx-4 bg-white shadow-xl rounded-xl">
        <h3 class="mb-2 text-base font-semibold text-gray-900">ยืนยันการลบ</h3>
        <p class="mb-6 text-sm text-gray-500">
          ลบ "<span class="font-medium text-gray-700">{{ deleteTarget.number }}</span>"
          และ items ทั้งหมดภายใน? การกระทำนี้ไม่สามารถยกเลิกได้
        </p>
        <div class="flex justify-end gap-3">
          <button type="button" @click="deleteTarget = null"
                  class="px-4 py-2 text-sm text-gray-600 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
            ยกเลิก
          </button>
          <button type="button" @click="doDelete"
                  class="px-4 py-2 text-sm text-white transition-colors bg-red-500 rounded-lg hover:bg-red-600">
            ลบ
          </button>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
  criteria:    Object,
  subCriteria: Array,
  allCriteria: Array,
})

const deleteTarget = ref(null)
function confirmDelete(sub) { deleteTarget.value = sub }
function doDelete() {
  router.delete(route('admin.criteria.sub-criteria.destroy', [
    props.criteria.id, deleteTarget.value.id,
  ]), { onFinish: () => { deleteTarget.value = null } })
}
</script>
