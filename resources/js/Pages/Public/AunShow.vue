<template>
  <PublicLayout :allCriteria="allCriteria" :currentNum="currentNum">
    <Head :title="`AUN ${criteria.number} · ${criteria.title}`" />

    <div class="max-w-4xl px-6 py-8 mx-auto">

      <!-- Page header -->
      <div class="pb-5 mb-8 border-b border-gray-200">
        <span class="inline-block text-xs font-semibold text-primary-500 bg-primary-50 px-2.5 py-1 rounded-full mb-2">
          AUN {{ criteria.number }}
        </span>
        <h1 class="text-2xl font-semibold text-gray-900">{{ criteria.title }}</h1>
        <p v-if="criteria.description" class="mt-2 text-sm text-gray-500">
          {{ criteria.description }}
        </p>
      </div>

      <!-- Sub-criteria sections -->
      <div
        v-for="(sub, idx) in criteria.sub_criteria"
        :key="sub.id"
        class="mb-10"
      >
        <!-- Sub-criteria header -->
        <div class="flex items-baseline gap-3 mb-4">
          <span class="text-xs font-semibold text-primary-500 bg-primary-50 px-2 py-0.5 rounded whitespace-nowrap">
            {{ sub.number }}
          </span>
          <h2 class="text-sm leading-relaxed text-gray-600">{{ sub.title }}</h2>
        </div>

        <!-- Items list -->
        <div v-if="sub.items && sub.items.length > 0" class="pl-2 space-y-2">
          <Link
            v-for="item in sub.items"
            :key="item.id"
            :href="route('aun.item.show', { number: criteria.number, item: item.id })"
            class="flex items-center justify-between gap-4 px-4 py-3 transition-colors bg-white border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 group"
          >
            <div class="flex items-center gap-3">
              <svg class="flex-shrink-0 w-4 h-4 text-gray-300 group-hover:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <span class="text-sm text-gray-700 group-hover:text-primary-700">{{ item.title }}</span>
            </div>
            <svg class="flex-shrink-0 w-4 h-4 text-gray-300 group-hover:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </Link>
        </div>

        <!-- Empty state -->
        <div v-else class="pl-2">
          <div class="px-4 py-3 border border-gray-200 border-dashed rounded-lg bg-gray-50">
            <p class="text-xs text-gray-400">ยังไม่มีเนื้อหา</p>
          </div>
        </div>

        <!-- Divider ยกเว้นข้อสุดท้าย -->
        <hr v-if="idx < criteria.sub_criteria.length - 1" class="mt-8 border-gray-100" />
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
