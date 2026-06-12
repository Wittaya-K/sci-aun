<template>
  <PublicLayout :allCriteria="allCriteria" :currentNum="currentNum">
    <Head :title="`AUN ${criteria.number} · ${criteria.title}`" />

    <div class="max-w-4xl px-4 py-6 mx-auto sm:px-6 sm:py-8">

      <!-- Page header -->
      <div class="pb-4 mb-6 border-b border-gray-200 sm:mb-8 sm:pb-5">
        <span class="inline-block text-xs font-semibold text-primary-500 bg-primary-50 px-2.5 py-1 rounded-full mb-2">
          AUN {{ criteria.number }}
        </span>
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">{{ criteria.title }}</h1>
        <p v-if="criteria.description" class="mt-2 text-sm text-gray-500">
          {{ criteria.description }}
        </p>
      </div>

      <!-- Sub-criteria sections -->
      <div
        v-for="(sub, idx) in criteria.sub_criteria"
        :key="sub.id"
        class="mb-8 sm:mb-10"
      >
        <!-- Sub-criteria header -->
        <div class="flex flex-col sm:flex-row sm:items-baseline gap-1.5 sm:gap-3 mb-3 sm:mb-4">
          <span class="text-xs font-semibold text-primary-500 bg-primary-50 px-2 py-0.5 rounded whitespace-nowrap self-start">
            {{ sub.number }}
          </span>
          <h2 class="text-sm leading-relaxed text-gray-600">{{ sub.title }}</h2>
        </div>

        <!-- Items list -->
        <div v-if="sub.items && sub.items.length > 0" class="space-y-2 sm:pl-2">
          <Link
            v-for="item in sub.items"
            :key="item.id"
            :href="route('aun.item.show', { number: criteria.number, item: item.id })"
            class="flex items-center justify-between gap-3 sm:gap-4 px-3 sm:px-4 py-3 bg-white border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition-colors group active:scale-[0.99]"
          >
            <div class="flex items-center gap-2.5 sm:gap-3 min-w-0">
              <svg class="flex-shrink-0 w-4 h-4 text-gray-300 group-hover:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <span class="text-sm text-gray-700 truncate group-hover:text-primary-700">{{ item.title }}</span>
            </div>
            <svg class="flex-shrink-0 w-4 h-4 text-gray-300 group-hover:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </Link>
        </div>

        <!-- Empty state -->
        <div v-else class="sm:pl-2">
          <div class="px-3 py-3 border border-gray-200 border-dashed rounded-lg sm:px-4 bg-gray-50">
            <p class="text-xs text-gray-400">ยังไม่มีเนื้อหา</p>
          </div>
        </div>

        <!-- Divider ยกเว้นข้อสุดท้าย -->
        <hr v-if="idx < criteria.sub_criteria.length - 1" class="mt-6 border-gray-100 sm:mt-8" />
      </div>

    </div>
  </PublicLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'

defineProps({
  criteria:    Object,
  allCriteria: Array,
  currentNum:  Number,
})
</script>