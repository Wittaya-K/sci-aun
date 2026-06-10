<template>
  <div class="flex flex-col min-h-screen bg-gray-50">

    <!-- Top bar -->
    <header class="sticky top-0 z-10 flex items-center gap-3 px-6 py-3 bg-white border-b border-gray-200">
      <!-- <img src="/images/psu-logo.png" alt="PSU" class="w-auto h-8" /> -->
       <img src="/images/psu-logo.jpg" alt="PSU" class="w-auto h-8" />
      <div>
        <div class="text-xs leading-none text-gray-400">คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์</div>
        <!-- <div class="text-sm font-semibold leading-tight text-primary-500">AUN-QA Evidence</div> -->
         <div class="text-sm font-semibold leading-tight text-primary-500">Sources of Evidence-AUN-SCIENCE</div>
      </div>
    </header>

    <div class="flex flex-1 overflow-hidden">

      <!-- Sidebar -->
      <aside class="flex-shrink-0 w-56 overflow-y-auto bg-white border-r border-gray-200">
        <nav class="py-4">
          <div class="px-4 mb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">
            AUN-QA Criteria
          </div>
          <Link
            v-for="c in allCriteria"
            :key="c.id"
            :href="route('aun.show', c.number)"
            class="flex items-start gap-2 px-4 py-2.5 text-sm transition-colors border-l-2"
            :class="c.number === currentNum
              ? 'border-primary-500 bg-primary-50 text-primary-600 font-medium'
              : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-gray-900'"
          >
            <span
              class="text-[10px] font-bold mt-0.5 min-w-[18px]"
              :class="c.number === currentNum ? 'text-primary-500' : 'text-gray-400'"
            >
              {{ c.number }}
            </span>
            <span class="leading-snug">{{ c.title }}</span>
          </Link>
        </nav>
      </aside>

      <!-- Main content -->
      <main class="flex-1 overflow-y-auto">
        <slot />
      </main>

    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  allCriteria: Array,
  currentNum:  Number,
})
</script>
