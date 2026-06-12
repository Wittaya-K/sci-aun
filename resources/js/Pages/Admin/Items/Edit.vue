<template>
  <AdminLayout :allCriteria="allCriteria" :activeCriteriaId="criteria.id">
    <Head :title="item ? `แก้ไข · ${item.title}` : 'เพิ่ม Item'" />

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 mb-4 overflow-x-auto text-xs text-gray-400 sm:text-sm sm:mb-6 whitespace-nowrap">
      <Link :href="route('admin.criteria.sub-criteria.index', criteria.id)"
            class="flex-shrink-0 transition-colors hover:text-primary-500">AUN {{ criteria.number }}</Link>
      <span class="flex-shrink-0">/</span>
      <Link :href="route('admin.criteria.sub-criteria.items.index', [criteria.id, subCriteria.id])"
            class="flex-shrink-0 transition-colors hover:text-primary-500">{{ subCriteria.number }}</Link>
      <span class="flex-shrink-0">/</span>
      <span class="flex-shrink-0 text-gray-700">{{ item ? 'แก้ไข' : 'เพิ่ม Item' }}</span>
    </div>

    <div class="max-w-3xl">
      <h1 class="mb-4 text-base font-semibold text-gray-900 sm:text-lg sm:mb-6">
        {{ item ? 'แก้ไข Item' : 'เพิ่ม Item ใหม่' }}
      </h1>

      <form @submit.prevent="submit" class="space-y-5 sm:space-y-6">

        <!-- Title -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">ชื่อ Item <span class="text-red-400">*</span></label>
          <input v-model="form.title" type="text"
                 class="w-full px-3 py-2 text-sm transition border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400"
                 placeholder="เช่น รายละเอียดหลักสูตร (มคอ.2)" required />
          <p v-if="errors.title" class="mt-1 text-xs text-red-500">{{ errors.title }}</p>
        </div>

        <!-- Body (TipTap) -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1.5">เนื้อหา</label>
          <TipTapEditor v-model="form.body" placeholder="พิมพ์เนื้อหา หรือวาง rich text ที่นี่..." />
          <p v-if="errors.body" class="mt-1 text-xs text-red-500">{{ errors.body }}</p>
        </div>

        <!-- Save button -->
        <div class="flex items-center gap-3 pt-2">
          <button type="submit" :disabled="form.processing"
                  class="px-5 py-2 text-sm font-medium text-white transition-colors rounded-lg sm:px-6 bg-primary-500 hover:bg-primary-600 disabled:opacity-50">
            {{ form.processing ? 'กำลังบันทึก...' : 'บันทึก' }}
          </button>
          <Link :href="route('admin.criteria.sub-criteria.items.index', [criteria.id, subCriteria.id])"
                class="px-4 py-2 text-sm text-gray-600 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
            ยกเลิก
          </Link>
        </div>
      </form>

      <!-- ─── Attachments (แสดงหลัง save แล้วเท่านั้น) ─── -->
      <div v-if="item" class="pt-6 mt-8 border-t border-gray-200 sm:mt-10 sm:pt-8">
        <h2 class="mb-4 text-sm font-semibold text-gray-900 sm:text-base">ไฟล์แนบ</h2>

        <!-- Upload area -->
        <div class="grid grid-cols-1 gap-3 mb-6 sm:grid-cols-2 sm:gap-4">
          <!-- Image upload -->
          <div>
            <p class="mb-2 text-xs font-medium text-gray-500">รูปภาพ (JPG, PNG, WEBP)</p>
            <label class="flex flex-col items-center justify-center h-20 transition-colors border-2 border-gray-200 border-dashed rounded-lg cursor-pointer sm:h-24 hover:border-primary-300 hover:bg-primary-50">
              <svg class="w-6 h-6 mb-1 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              <span class="text-xs text-gray-400">คลิกเพื่ออัพโหลด</span>
              <input type="file" class="hidden" accept="image/*" @change="uploadFile($event, 'image')" />
            </label>
          </div>
          <!-- PDF upload -->
          <div>
            <p class="mb-2 text-xs font-medium text-gray-500">PDF (More Information)</p>
            <label class="flex flex-col items-center justify-center h-20 transition-colors border-2 border-gray-200 border-dashed rounded-lg cursor-pointer sm:h-24 hover:border-red-200 hover:bg-red-50">
              <svg class="w-6 h-6 mb-1 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
              </svg>
              <span class="text-xs text-gray-400">คลิกเพื่ออัพโหลด PDF</span>
              <input type="file" class="hidden" accept="application/pdf" @change="uploadFile($event, 'pdf')" />
            </label>
          </div>
        </div>

        <!-- Upload progress -->
        <div v-if="uploading" class="mb-4 px-4 py-2.5 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-600 flex items-center gap-2">
          <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
          </svg>
          กำลังอัพโหลด...
        </div>

        <!-- Attachment list -->
        <div v-if="attachments.length > 0" class="space-y-2">
          <!-- Images -->
          <div v-if="images.length > 0">
            <p class="mb-2 text-xs font-semibold tracking-widest text-gray-400 uppercase">รูปภาพ</p>
            <div class="grid grid-cols-2 gap-2 mb-4 sm:grid-cols-3 sm:gap-3">
              <div v-for="att in images" :key="att.id"
                   class="relative overflow-hidden border border-gray-200 rounded-lg group bg-gray-50">
                <img :src="att.url" :alt="att.caption || att.filename" class="object-cover w-full h-24" />
                <!-- Mobile: always-visible delete button -->
                <button type="button" @click="deleteAttachment(att)"
                        class="absolute p-1 text-white transition-opacity rounded-full top-1 right-1 bg-red-500/90 sm:opacity-0 sm:group-hover:opacity-100">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </button>
                <p v-if="att.caption" class="text-[10px] text-gray-400 text-center px-1 py-1 truncate">{{ att.caption }}</p>
              </div>
            </div>
          </div>

          <!-- PDFs -->
          <div v-if="pdfs.length > 0">
            <p class="mb-2 text-xs font-semibold tracking-widest text-gray-400 uppercase">PDF</p>
            <div class="space-y-2">
              <div v-for="att in pdfs" :key="att.id"
                   class="flex items-center gap-2 sm:gap-3 px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg">
                <div class="flex items-center justify-center flex-shrink-0 rounded w-7 h-7 bg-red-50">
                  <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 1.5L18.5 9H13V3.5z"/>
                  </svg>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-sm text-gray-700 truncate">{{ att.caption || att.filename }}</p>
                  <p class="text-xs text-gray-400 truncate">{{ att.filename }}</p>
                </div>
                <a :href="att.url" target="_blank"
                   class="flex-shrink-0 text-xs text-primary-500 hover:text-primary-600">ดู</a>
                <button type="button" @click="deleteAttachment(att)"
                        class="flex-shrink-0 text-xs text-red-400 hover:text-red-600">ลบ</button>
              </div>
            </div>
          </div>
        </div>

        <!-- No attachments -->
        <div v-else class="py-8 text-center border border-gray-200 border-dashed rounded-lg bg-gray-50">
          <p class="text-xs text-gray-400">ยังไม่มีไฟล์แนบ</p>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import TipTapEditor from '@/Components/TipTapEditor.vue'
import axios from 'axios'

const props = defineProps({
  criteria:    Object,
  subCriteria: Object,
  item:        Object,
  allCriteria: Array,
})

const form = useForm({
  title:      props.item?.title      || '',
  body:       props.item?.body       || '',
  sort_order: props.item?.sort_order || 0,
})

const errors = computed(() => form.errors)

function submit() {
  if (props.item) {
    form.put(route('admin.criteria.sub-criteria.items.update', [
      props.criteria.id, props.subCriteria.id, props.item.id,
    ]))
  } else {
    form.post(route('admin.criteria.sub-criteria.items.store', [
      props.criteria.id, props.subCriteria.id,
    ]))
  }
}

const attachments = ref(props.item?.attachments || [])
const uploading   = ref(false)

const images = computed(() => attachments.value.filter(a => a.type === 'image'))
const pdfs   = computed(() => attachments.value.filter(a => a.type === 'pdf'))

async function uploadFile(event, type) {
  const file = event.target.files[0]
  if (!file) return

  const formData = new FormData()
  formData.append('file', file)
  formData.append('type', type)

  uploading.value = true
  try {
    const { data } = await axios.post(
      route('admin.criteria.sub-criteria.items.attachments.upload', [
        props.criteria.id, props.subCriteria.id, props.item.id,
      ]),
      formData,
      { headers: { 'Content-Type': 'multipart/form-data' } }
    )
    attachments.value.push(data.attachment)
  } catch (e) {
    alert('อัพโหลดไม่สำเร็จ กรุณาลองอีกครั้ง')
  } finally {
    uploading.value = false
    event.target.value = ''
  }
}

async function deleteAttachment(att) {
  if (!confirm(`ลบไฟล์ "${att.filename}"?`)) return
  try {
    await axios.delete(route('admin.criteria.sub-criteria.items.attachments.destroy', [
      props.criteria.id, props.subCriteria.id, props.item.id, att.id,
    ]))
    attachments.value = attachments.value.filter(a => a.id !== att.id)
  } catch (e) {
    alert('ลบไม่สำเร็จ กรุณาลองอีกครั้ง')
  }
}
</script>