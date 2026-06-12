<template>
  <AdminLayout :allCriteria="allCriteria" :activeCriteriaId="criteria.id">
    <Head :title="`${subCriteria.number} · Items`" />

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-4 overflow-x-auto text-xs text-gray-400 sm:text-sm sm:mb-6 whitespace-nowrap">
      <Link :href="route('admin.criteria.sub-criteria.index', criteria.id)"
            class="flex-shrink-0 transition-colors hover:text-primary-500">
        AUN {{ criteria.number }}
      </Link>
      <span class="flex-shrink-0">/</span>
      <span class="flex-shrink-0 font-medium text-gray-700">{{ subCriteria.number }}</span>
    </div>

    <!-- Header -->
    <div class="flex flex-col gap-3 mb-5 sm:flex-row sm:items-center sm:justify-between sm:mb-6">
      <div class="min-w-0">
        <h1 class="text-base font-semibold text-gray-900 sm:text-lg">{{ subCriteria.number }}</h1>
        <p class="text-xs sm:text-sm text-gray-500 mt-0.5 leading-relaxed">{{ subCriteria.title }}</p>
      </div>
      <Link :href="route('admin.criteria.sub-criteria.items.create', [criteria.id, subCriteria.id])"
            class="flex items-center justify-center flex-shrink-0 gap-2 px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-500 hover:bg-primary-600">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        เพิ่ม Item
      </Link>
    </div>

    <!-- Items list -->
    <div v-if="items.length > 0" class="space-y-2">
      <div v-for="item in items" :key="item.id"
           class="flex flex-col gap-2 px-3 py-3 bg-white border border-gray-200 rounded-lg sm:px-4 sm:flex-row sm:items-center sm:justify-between sm:gap-4">
        <div class="flex items-center gap-2.5 sm:gap-3 min-w-0">
          <svg class="flex-shrink-0 w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <span class="text-sm text-gray-700 truncate">{{ item.title }}</span>
          <span class="flex-shrink-0 text-xs text-gray-400">{{ item.attachments_count }} ไฟล์</span>
        </div>
        <div class="flex items-center self-end flex-shrink-0 gap-2 sm:self-auto">
          <Link :href="route('admin.criteria.sub-criteria.items.edit', [criteria.id, subCriteria.id, item.id])"
                class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition-colors">
            แก้ไข
          </Link>
          <button type="button" @click="confirmDelete(item)"
                  class="text-xs px-3 py-1.5 bg-red-50 text-red-500 rounded hover:bg-red-100 transition-colors">
            ลบ
          </button>
        </div>
      </div>
    </div>

    <!-- Empty state -->
    <div v-else class="py-12 text-center bg-white border border-gray-200 border-dashed rounded-lg sm:py-16">
      <svg class="w-10 h-10 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
      </svg>
      <p class="mb-3 text-sm text-gray-400">ยังไม่มี Item</p>
      <Link :href="route('admin.criteria.sub-criteria.items.create', [criteria.id, subCriteria.id])"
            class="text-sm font-medium text-primary-500 hover:text-primary-600">
        + เพิ่ม Item แรก
      </Link>
    </div>

    <!-- Delete confirm modal -->
    <div v-if="deleteTarget"
         class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/40"
         @click.self="deleteTarget = null">
      <div class="w-full max-w-sm p-5 bg-white shadow-xl rounded-xl sm:p-6">
        <h3 class="mb-2 text-base font-semibold text-gray-900">ยืนยันการลบ</h3>
        <p class="mb-6 text-sm text-gray-500">
          ลบ "<span class="font-medium text-gray-700">{{ deleteTarget.title }}</span>" และไฟล์แนบทั้งหมด?
          การกระทำนี้ไม่สามารถยกเลิกได้
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
  subCriteria: Object,
  items:       Array,
  allCriteria: Array,
})

const deleteTarget = ref(null)
function confirmDelete(item) { deleteTarget.value = item }
function doDelete() {
  router.delete(route('admin.criteria.sub-criteria.items.destroy', [
    props.criteria.id, props.subCriteria.id, deleteTarget.value.id,
  ]), { onFinish: () => { deleteTarget.value = null } })
}
</script>