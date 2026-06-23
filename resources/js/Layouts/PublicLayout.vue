<template>
  <div class="flex flex-col min-h-screen bg-gray-50">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex items-center justify-between px-4 py-3 bg-white border-b border-gray-200 sm:px-6">
      <div class="flex items-center min-w-0 gap-2 sm:gap-3">
        <!-- Hamburger (mobile only) -->
        <button type="button" @click="sidebarOpen = true"
                class="lg:hidden p-1.5 -ml-1.5 text-gray-500 hover:text-primary-500 hover:bg-gray-100 rounded transition-colors flex-shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>

        <img src="/images/psu-logo.png" alt="PSU" class="flex-shrink-0 w-auto h-7 sm:h-8" />
        <div class="min-w-0">
          <div class="text-[10px] sm:text-xs leading-none text-gray-400 truncate">คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์</div>
          <div class="text-xs font-semibold leading-tight truncate sm:text-sm text-primary-500">AUN-QA Evidence</div>
        </div>
      </div>
    </header>

    <div class="relative flex flex-1 overflow-hidden">

      <!-- Mobile overlay -->
      <div v-if="sidebarOpen"
           class="fixed inset-0 z-30 bg-black/40 lg:hidden"
           @click="sidebarOpen = false" />

      <!-- Sidebar -->
      <aside
        class="fixed inset-y-0 left-0 z-40 flex-shrink-0 w-64 overflow-y-auto transition-transform duration-200 bg-white border-r border-gray-200 lg:static lg:w-56 lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
      >
        <!-- Mobile close button -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 lg:hidden">
          <span class="text-xs font-semibold tracking-widest text-gray-400 uppercase">AUN-QA Criteria</span>
          <button type="button" @click="sidebarOpen = false" class="p-1 text-gray-400 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <nav class="py-4">
          <div class="hidden lg:block px-4 mb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">
            AUN-QA Criteria
          </div>
          <Link
            v-for="c in allCriteria"
            :key="c.id"
            :href="route('aun.show', c.number)"
            @click="sidebarOpen = false"
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
      <main class="flex flex-col flex-1 overflow-y-auto">
        <div class="flex-1">
          <slot />
        </div>

        <!-- Footer -->
        <footer class="px-4 py-4 mt-auto bg-white border-t border-gray-200 sm:px-6">
          <div class="flex flex-col items-center justify-center gap-3 text-xs text-center text-gray-400">

            <!-- หน่วยงาน -->
            <div>
              สาขาวิทยาศาสตร์การคำนวณ คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์
            </div>

            <!-- contact -->
            <div class="flex flex-col items-center gap-2 sm:flex-row sm:gap-6">

              <a href="tel:0936398064" class="flex items-center gap-1 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102A1.125 1.125 0 0 0 5.872 2.25H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                09-3639-8064
              </a>

              <a href="mailto:wittaya.kh@psu.ac.th" class="flex items-center gap-1 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15A2.25 2.25 0 0 0 2.25 6.75m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91A2.25 2.25 0 0 1 2.25 6.993V6.75" />
                </svg>
                wittaya.kh@psu.ac.th
              </a>

            </div>
          </div>
        </footer>
      </main>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({
  allCriteria: Array,
  currentNum:  Number,
})

const sidebarOpen = ref(false)

router.on('navigate', () => {
  sidebarOpen.value = false
})
</script>