<template>
  <div class="flex flex-col min-h-screen bg-gray-50">

    <!-- Top bar -->
    <header class="sticky top-0 z-20 flex items-center justify-between px-4 py-3 bg-white border-b border-gray-200 sm:px-6">
      <div class="flex items-center min-w-0 gap-2 sm:gap-3">
        <!-- Hamburger (mobile) -->
        <button type="button" @click="sidebarOpen = true"
                class="lg:hidden p-1.5 -ml-1.5 text-gray-500 hover:text-primary-500 hover:bg-gray-100 rounded transition-colors flex-shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>

        <!-- <img src="/images/psu-logo.jpg" alt="PSU" class="flex-shrink-0 w-auto h-7 sm:h-8" /> -->
        <img src="/images/psu-logo.png" alt="PSU" class="flex-shrink-0 w-auto h-7 sm:h-8" />
        <div class="min-w-0">
          <div class="hidden text-xs leading-none text-gray-400 truncate sm:block">คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์</div>
          <div class="text-xs font-semibold leading-tight truncate sm:text-sm text-primary-500">AUN-QA Admin</div>
        </div>
      </div>

      <div class="flex items-center flex-shrink-0 gap-2 sm:gap-4">
        <a :href="route('aun.show', 1)" target="_blank"
           class="items-center hidden gap-1 text-xs text-gray-400 transition-colors sm:flex hover:text-primary-500">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
          </svg>
          ดูหน้าสาธารณะ
        </a>

        <span class="hidden sm:inline text-xs text-gray-400 truncate max-w-[120px]">{{ $page.props.auth.user?.name }}</span>

        <!-- Logout -->
        <button type="button" @click="logout"
                class="flex items-center gap-1 text-xs text-gray-400 transition-colors hover:text-red-500">
          <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          <span class="hidden sm:inline">ออกจากระบบ</span>
        </button>
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
        <!-- Mobile header -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 lg:hidden">
          <span class="text-xs font-semibold tracking-widest text-gray-400 uppercase">จัดการ AUN-QA</span>
          <button type="button" @click="sidebarOpen = false" class="p-1 text-gray-400 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <nav class="py-4">
          <div class="hidden lg:block px-4 mb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">
            จัดการ AUN-QA
          </div>
          <Link v-for="c in allCriteria" :key="c.id"
                :href="route('admin.criteria.sub-criteria.index', c.id)"
                @click="sidebarOpen = false"
                class="flex items-start gap-2 px-4 py-2.5 text-sm transition-colors border-l-2"
                :class="activeCriteriaId === c.id
                  ? 'border-primary-500 bg-primary-50 text-primary-600 font-medium'
                  : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-gray-900'">
            <span class="text-[10px] font-bold mt-0.5 min-w-[18px]"
                  :class="activeCriteriaId === c.id ? 'text-primary-500' : 'text-gray-400'">
              {{ c.number }}
            </span>
            <span class="leading-snug">{{ c.title }}</span>
          </Link>

          <div class="px-4 mt-4 mb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest border-t border-gray-100 pt-4">
            ระบบ
          </div>
          <Link :href="route('admin.users.index')"
                @click="sidebarOpen = false"
                class="flex items-center gap-2 px-4 py-2.5 text-sm transition-colors border-l-2"
                :class="$page.url.startsWith('/admin/users')
                  ? 'border-primary-500 bg-primary-50 text-primary-600 font-medium'
                  : 'border-transparent text-gray-600 hover:bg-gray-50 hover:text-gray-900'">
            <svg class="flex-shrink-0 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/>
            </svg>
            จัดการผู้ใช้
          </Link>

          <!-- Mobile-only: link to public site -->
          <a :href="route('aun.show', 1)" target="_blank"
             class="sm:hidden flex items-center gap-2 px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors border-l-2 border-transparent">
            <svg class="flex-shrink-0 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            ดูหน้าสาธารณะ
          </a>
        </nav>
      </aside>

      <!-- Main -->
      <main class="flex-1 p-4 overflow-x-hidden overflow-y-auto sm:p-6">
        <div v-if="$page.props.flash?.success"
             class="flex items-center gap-2 px-4 py-3 mb-4 text-sm text-green-700 border border-green-200 rounded-lg bg-green-50">
          <svg class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                  clip-rule="evenodd"/>
          </svg>
          {{ $page.props.flash.success }}
        </div>
        <div v-if="$page.props.flash?.error"
             class="flex items-center gap-2 px-4 py-3 mb-4 text-sm text-red-700 border border-red-200 rounded-lg bg-red-50">
          {{ $page.props.flash.error }}
        </div>
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({
  allCriteria:      Array,
  activeCriteriaId: Number,
})

const sidebarOpen = ref(false)

router.on('navigate', () => {
  sidebarOpen.value = false
})

function logout() {
  router.post(route('logout'))
}
</script>