<template>
  <AdminLayout :allCriteria="allCriteria" :activeCriteriaId="null">
    <Head title="จัดการผู้ใช้" />

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-lg font-semibold text-gray-900">จัดการผู้ใช้</h1>
      <Link :href="route('admin.users.create')"
            class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-500 hover:bg-primary-600">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        เพิ่มผู้ใช้
      </Link>
    </div>

    <!-- Error flash -->
    <div v-if="$page.props.flash?.error"
         class="px-4 py-3 mb-4 text-sm text-red-700 border border-red-200 rounded-lg bg-red-50">
      {{ $page.props.flash.error }}
    </div>

    <!-- Users table -->
    <div class="overflow-hidden bg-white border border-gray-200 rounded-lg">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-gray-200 bg-gray-50">
            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ชื่อ</th>
            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
            <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">วันที่สร้าง</th>
            <th class="px-4 py-3"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-for="user in users" :key="user.id" class="transition-colors hover:bg-gray-50">
            <td class="px-4 py-3">
              <div class="flex items-center gap-3">
                <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-full bg-primary-100">
                  <span class="text-xs font-semibold text-primary-600">
                    {{ user.name.charAt(0).toUpperCase() }}
                  </span>
                </div>
                <div>
                  <p class="font-medium text-gray-900">{{ user.name }}</p>
                  <p v-if="user.id === $page.props.auth.user.id"
                     class="text-[10px] text-primary-500 font-medium">คุณ</p>
                </div>
              </div>
            </td>
            <td class="px-4 py-3 text-gray-600">{{ user.email }}</td>
            <td class="px-4 py-3 text-xs text-gray-400">{{ formatDate(user.created_at) }}</td>
            <td class="px-4 py-3">
              <div class="flex items-center justify-end gap-2">
                <Link :href="route('admin.users.edit', user.id)"
                      class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition-colors">
                  แก้ไข
                </Link>
                <button
                  v-if="user.id !== $page.props.auth.user.id"
                  type="button"
                  @click="confirmDelete(user)"
                  class="text-xs px-3 py-1.5 bg-red-50 text-red-500 rounded hover:bg-red-100 transition-colors">
                  ลบ
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Delete modal -->
    <div v-if="deleteTarget" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
         @click.self="deleteTarget = null">
      <div class="w-full max-w-sm p-6 mx-4 bg-white shadow-xl rounded-xl">
        <h3 class="mb-2 text-base font-semibold text-gray-900">ยืนยันการลบ</h3>
        <p class="mb-6 text-sm text-gray-500">
          ลบผู้ใช้ "<span class="font-medium text-gray-700">{{ deleteTarget.name }}</span>"?
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

defineProps({
  users:       Array,
  allCriteria: Array,
})

const deleteTarget = ref(null)
function confirmDelete(user) { deleteTarget.value = user }
function doDelete() {
  router.delete(route('admin.users.destroy', deleteTarget.value.id), {
    onFinish: () => { deleteTarget.value = null },
  })
}

function formatDate(dateStr) {
  return new Date(dateStr).toLocaleDateString('th-TH', {
    year: 'numeric', month: 'short', day: 'numeric',
  })
}
</script>
