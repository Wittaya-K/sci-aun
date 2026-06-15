<template>
  <PublicLayout :allCriteria="allCriteria" :currentNum="currentNum">
    <Head :title="item.title" />

    <div class="max-w-4xl px-4 py-6 mx-auto sm:px-6 sm:py-8">

      <!-- Breadcrumb / back -->
      <div class="flex items-center gap-1.5 sm:gap-2 mb-4 sm:mb-6 text-xs sm:text-sm text-gray-400 overflow-hidden">
        <Link
          :href="route('aun.show', criteria.number)"
          class="flex items-center flex-shrink-0 gap-1 transition-colors hover:text-primary-500"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          AUN {{ criteria.number }}
        </Link>
        <span class="flex-shrink-0">/</span>
        <span class="flex-shrink-0 font-medium text-primary-400">{{ subCriteria.number }}</span>
        <span class="flex-shrink-0 hidden sm:inline">/</span>
        <span class="hidden text-gray-500 truncate sm:inline">{{ item.title }}</span>
      </div>

      <!-- Item header -->
      <div class="pb-4 mb-5 border-b border-gray-200 sm:mb-6 sm:pb-5">
        <div class="flex items-center gap-2 mb-2">
          <span class="text-xs font-semibold text-primary-500 bg-primary-50 px-2 py-0.5 rounded">
            {{ subCriteria.number }}
          </span>
        </div>
        <p class="text-xs text-gray-400 mb-1.5 leading-relaxed">{{ subCriteria.title }}</p>
        <h1 class="text-lg font-semibold leading-snug text-gray-900 sm:text-xl">{{ item.title }}</h1>
      </div>

      <!-- Rich text body -->
      <div
        v-if="item.body"
        class="mb-6 prose-sm prose text-gray-700 sm:prose-base max-w-none prose-headings:text-gray-800 prose-a:text-primary-500 prose-a:no-underline hover:prose-a:underline prose-a:break-words prose-li:marker:text-primary-400 prose-img:rounded-lg sm:mb-8 aun-body"
        v-html="item.body"
      />

      <!-- Images -->
      <div v-if="item.images && item.images.length > 0" class="mb-6 sm:mb-8">
        <h2 class="mb-3 text-xs font-semibold tracking-widest text-gray-400 uppercase">รูปภาพประกอบ</h2>
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 sm:gap-4">
          <div
            v-for="img in item.images"
            :key="img.id"
            class="overflow-hidden border border-gray-200 rounded-lg bg-gray-50"
          >
            <img
              :src="img.url"
              :alt="img.caption || item.title"
              class="object-contain w-full max-h-64 sm:max-h-80"
              loading="lazy"
            />
            <p v-if="img.caption" class="px-3 py-2 text-xs text-center text-gray-400">
              {{ img.caption }}
            </p>
          </div>
        </div>
      </div>

      <!-- More Information (เอกสารแนบ: PDF / Word / Excel / PowerPoint) -->
      <div v-if="item.documents && item.documents.length > 0" class="pt-5 mt-6 border-t border-gray-100 sm:mt-8 sm:pt-6">
        <h2 class="mb-3 text-xs font-semibold tracking-widest text-gray-400 uppercase">
          More Information
        </h2>
        <div class="space-y-2">
          <a
            v-for="doc in item.documents"
            :key="doc.id"
            :href="doc.url"
            :download="doc.filename"
            class="flex items-center gap-3 px-3 sm:px-4 py-3 bg-white border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition-colors group active:scale-[0.99]"
          >
            <FileIcon :filename="doc.filename" />
            <div class="flex-1 min-w-0">
              <p class="text-sm text-gray-700 truncate group-hover:text-primary-700">
                {{ doc.caption || doc.filename }}
              </p>
              <p class="text-xs text-gray-400">ดาวน์โหลด</p>
            </div>
            <!-- Download icon -->
            <svg class="flex-shrink-0 w-4 h-4 text-gray-300 group-hover:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
          </a>
        </div>
      </div>

    </div>
  </PublicLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'
import FileIcon from '@/Components/FileIcon.vue'

defineProps({
  criteria:    Object,
  subCriteria: Object,
  item:        Object,
  allCriteria: Array,
  currentNum:  Number,
})
</script>

<style scoped>
/* Table styles สำหรับเนื้อหาที่ render จาก v-html */
:deep(.aun-body table) {
  border-collapse: collapse;
  width: 100%;
  table-layout: fixed;
  margin: 1rem 0;
  font-size: 0.875rem;
}
:deep(.aun-body td),
:deep(.aun-body th) {
  border: 1px solid #e5e7eb;
  padding: 8px 12px;
  text-align: left;
  vertical-align: top;
}
:deep(.aun-body th) {
  background-color: #f9fafb;
  font-weight: 600;
  color: #374151;
}
:deep(.aun-body tr:nth-child(even)) {
  background-color: #fafafa;
}

/* Mobile: ตารางเลื่อนแนวนอนได้ */
@media (max-width: 640px) {
  :deep(.aun-body table) {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }
}
</style>