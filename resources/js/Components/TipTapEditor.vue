<template>
  <div class="overflow-hidden bg-white border border-gray-200 rounded-lg">
    <!-- Toolbar -->
    <div class="flex items-center gap-0.5 px-2 py-1.5 border-b border-gray-200 bg-gray-50 flex-wrap">
      <button type="button" @click="editor.chain().focus().toggleBold().run()"
              :class="btnClass(editor?.isActive('bold'))" title="Bold">
        <strong class="text-xs px-0.5">B</strong>
      </button>
      <button type="button" @click="editor.chain().focus().toggleItalic().run()"
              :class="btnClass(editor?.isActive('italic'))" title="Italic">
        <em class="text-xs px-0.5">I</em>
      </button>
      <div class="w-px h-5 mx-1 bg-gray-200"></div>
      <button type="button" @click="editor.chain().focus().toggleBulletList().run()"
              :class="btnClass(editor?.isActive('bulletList'))" title="Bullet List">
        <span class="text-xs px-0.5">• —</span>
      </button>
      <button type="button" @click="editor.chain().focus().toggleOrderedList().run()"
              :class="btnClass(editor?.isActive('orderedList'))" title="Ordered List">
        <span class="text-xs px-0.5">1.</span>
      </button>
      <div class="w-px h-5 mx-1 bg-gray-200"></div>
      <button type="button" @click="setLink"
              :class="btnClass(editor?.isActive('link'))" title="Link">
        <span class="text-xs px-0.5">🔗</span>
      </button>
      <button type="button" @click="editor.chain().focus().unsetLink().run()"
              :disabled="!editor?.isActive('link')"
              class="p-1.5 rounded text-gray-400 hover:bg-gray-200 disabled:opacity-30 disabled:cursor-not-allowed transition-colors"
              title="Remove Link">
        <span class="text-xs px-0.5">✕🔗</span>
      </button>
      <div class="w-px h-5 mx-1 bg-gray-200"></div>
      <button type="button" @click="editor.chain().focus().clearNodes().unsetAllMarks().run()"
              class="p-1.5 rounded text-gray-400 hover:bg-gray-200 transition-colors text-xs"
              title="Clear Formatting">
        Clear
      </button>
    </div>
    <!-- Editor -->
    <div class="min-h-[200px]">
      <editor-content :editor="editor" class="aun-editor" />
    </div>
  </div>
</template>

<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Link from '@tiptap/extension-link'
import Placeholder from '@tiptap/extension-placeholder'
import { watch, onBeforeUnmount } from 'vue'

const props = defineProps({
  modelValue:  { type: String, default: '' },
  placeholder: { type: String, default: 'พิมพ์เนื้อหาที่นี่...' },
})
const emit = defineEmits(['update:modelValue'])

const editor = useEditor({
  content: props.modelValue,
  extensions: [
    StarterKit.configure({
      heading: false, blockquote: false, codeBlock: false,
      horizontalRule: false, code: false,
    }),
    Link.configure({
      openOnClick: false,
      HTMLAttributes: { class: 'text-primary-500 underline', rel: 'noopener noreferrer', target: '_blank' },
    }),
    Placeholder.configure({ placeholder: props.placeholder }),
  ],
  onUpdate: ({ editor }) => emit('update:modelValue', editor.getHTML()),
})

watch(() => props.modelValue, (val) => {
  if (editor.value && editor.value.getHTML() !== val)
    editor.value.commands.setContent(val || '', false)
})

onBeforeUnmount(() => editor.value?.destroy())

function btnClass(isActive) {
  return ['p-1.5 rounded transition-colors',
    isActive ? 'bg-primary-100 text-primary-600' : 'text-gray-500 hover:bg-gray-200']
}

function setLink() {
  const prev = editor.value.getAttributes('link').href || ''
  const url  = window.prompt('URL:', prev)
  if (url === null) return
  if (url === '') { editor.value.chain().focus().unsetLink().run(); return }
  editor.value.chain().focus().setLink({ href: url }).run()
}
</script>

<style>
.aun-editor .ProseMirror {
  padding: 12px 16px; min-height: 200px; outline: none;
  font-size: 14px; line-height: 1.75; color: #374151;
}
.aun-editor .ProseMirror p { margin-bottom: 0.75rem; }
.aun-editor .ProseMirror ul, .aun-editor .ProseMirror ol { padding-left: 1.5rem; margin-bottom: 0.75rem; }
.aun-editor .ProseMirror li { margin-bottom: 0.25rem; }
.aun-editor .ProseMirror a { color: #185FA5; text-decoration: underline; }
.aun-editor .ProseMirror p.is-editor-empty:first-child::before {
  content: attr(data-placeholder); color: #9ca3af; pointer-events: none; float: left; height: 0;
}
</style>
