<template>
  <div class="flex items-center justify-center flex-shrink-0 font-bold tracking-wide rounded-lg"
       :class="[bgClass, textClass, sizeClass]">
    {{ label }}
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  filename: { type: String, required: true },
  size:     { type: String, default: 'md' }, // 'sm' | 'md'
})

const extension = computed(() => {
  const parts = props.filename.split('.')
  return parts.length > 1 ? parts.pop().toLowerCase() : ''
})

const fileType = computed(() => {
  const ext = extension.value
  if (ext === 'pdf') return 'pdf'
  if (['doc', 'docx'].includes(ext)) return 'word'
  if (['xls', 'xlsx', 'csv'].includes(ext)) return 'excel'
  if (['ppt', 'pptx'].includes(ext)) return 'powerpoint'
  return 'other'
})

const label = computed(() => ({
  pdf:        'PDF',
  word:       'DOC',
  excel:      'XLS',
  powerpoint: 'PPT',
  other:      (extension.value.slice(0, 3).toUpperCase() || 'FILE'),
}[fileType.value]))

const bgClass = computed(() => ({
  pdf:        'bg-red-50',
  word:       'bg-blue-50',
  excel:      'bg-green-50',
  powerpoint: 'bg-orange-50',
  other:      'bg-gray-100',
}[fileType.value]))

const textClass = computed(() => ({
  pdf:        'text-red-500',
  word:       'text-blue-600',
  excel:      'text-green-600',
  powerpoint: 'text-orange-500',
  other:      'text-gray-500',
}[fileType.value]))

const sizeClass = computed(() => props.size === 'sm'
  ? 'w-8 h-8 text-[9px]'
  : 'w-9 h-9 sm:w-10 sm:h-10 text-[10px]')
</script>