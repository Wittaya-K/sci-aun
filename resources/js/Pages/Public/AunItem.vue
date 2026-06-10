<template>
  <PublicLayout :allCriteria="allCriteria" :currentNum="currentNum">
    <Head :title="item.title" />

    <div class="max-w-4xl px-6 py-8 mx-auto">

      <!-- Breadcrumb / back -->
      <div class="flex items-center gap-2 mb-6 text-sm text-gray-400">
        <Link
          :href="route('aun.show', criteria.number)"
          class="flex items-center gap-1 transition-colors hover:text-primary-500"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          AUN {{ criteria.number }}
        </Link>
        <span>/</span>
        <span class="font-medium text-primary-400">{{ subCriteria.number }}</span>
        <span>/</span>
        <span class="max-w-xs text-gray-500 truncate">{{ item.title }}</span>
      </div>

      <!-- Item header -->
      <div class="pb-5 mb-6 border-b border-gray-200">
        <div class="flex items-center gap-2 mb-2">
          <span class="text-xs font-semibold text-primary-500 bg-primary-50 px-2 py-0.5 rounded">
            {{ subCriteria.number }}
          </span>
          <span class="text-xs text-gray-400">{{ subCriteria.title }}</span>
        </div>
        <h1 class="text-xl font-semibold text-gray-900">{{ item.title }}</h1>
      </div>

      <!-- Rich text body -->
      <div
        v-if="item.body"
        class="mb-8 prose-sm prose text-gray-700 max-w-none prose-headings:text-gray-800 prose-a:text-primary-500 prose-a:no-underline hover:prose-a:underline prose-li:marker:text-primary-400"
        v-html="item.body"
      />

      <!-- Images -->
      <div v-if="item.images && item.images.length > 0" class="mb-8">
        <h2 class="mb-3 text-xs font-semibold tracking-widest text-gray-400 uppercase">รูปภาพประกอบ</h2>
        <div class="grid gap-4" :class="item.images.length > 1 ? 'grid-cols-2' : 'grid-cols-1'">
          <div
            v-for="img in item.images"
            :key="img.id"
            class="overflow-hidden border border-gray-200 rounded-lg bg-gray-50"
          >
            <img
              :src="img.url"
              :alt="img.caption || item.title"
              class="object-contain w-full max-h-80"
            />
            <p v-if="img.caption" class="px-3 py-2 text-xs text-center text-gray-400">
              {{ img.caption }}
            </p>
          </div>
        </div>
      </div>

      <!-- More Information (PDF) -->
      <div v-if="item.pdfs && item.pdfs.length > 0" class="pt-6 mt-8 border-t border-gray-100">
        <h2 class="mb-3 text-xs font-semibold tracking-widest text-gray-400 uppercase">
          More Information
        </h2>
        <div class="space-y-2">
          <a
            v-for="pdf in item.pdfs"
            :key="pdf.id"
            :href="route('aun.item.pdf', { number: criteria.number, item: item.id, attachment: pdf.id })"
            target="_blank"
            rel="noopener noreferrer"
            class="flex items-center gap-3 px-4 py-3 transition-colors bg-white border border-gray-200 rounded-lg hover:border-red-300 hover:bg-red-50 group"
          >
            <!-- PDF icon -->
            <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 transition-colors rounded bg-red-50 group-hover:bg-red-100">
              <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM8.5 17.5h-1v-5h1.8c1.1 0 1.7.6 1.7 1.5 0 1-.7 1.6-1.8 1.6H8.5v1.9zm0-2.8h.7c.5 0 .8-.2.8-.7 0-.4-.3-.6-.8-.6H8.5v1.3zm5.3 2.8h-1.6v-5h1.6c1.5 0 2.5 1 2.5 2.5s-1 2.5-2.5 2.5zm-.6-4.1v3.2h.5c.9 0 1.5-.6 1.5-1.6s-.6-1.6-1.5-1.6h-.5zm5.3-.9v1h-1.8v1h1.6v.9h-1.6v2.1H15v-5h3.5v1z"/>
              </svg>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm text-gray-700 truncate group-hover:text-red-700">
                {{ pdf.caption || pdf.filename }}
              </p>
              <p class="text-xs text-gray-400">เปิดใน browser</p>
            </div>
            <!-- External link icon -->
            <svg class="flex-shrink-0 w-4 h-4 text-gray-300 group-hover:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
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

defineProps({
  criteria:    Object,
  subCriteria: Object,
  item:        Object,
  allCriteria: Array,
  currentNum:  Number,
})
</script>
