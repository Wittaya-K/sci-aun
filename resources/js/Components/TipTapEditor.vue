<template>
  <div class="overflow-hidden bg-white border border-gray-200 rounded-lg">
    <!-- Toolbar (scrollable on mobile) -->
    <div class="flex items-center gap-0.5 px-2 py-1.5 border-b border-gray-200 bg-gray-50 overflow-x-auto whitespace-nowrap">
      <button type="button" @click="editor.chain().focus().toggleBold().run()"
              :class="btnClass(editor?.isActive('bold'))" title="Bold">
        <strong class="text-xs px-0.5">B</strong>
      </button>
      <button type="button" @click="editor.chain().focus().toggleItalic().run()"
              :class="btnClass(editor?.isActive('italic'))" title="Italic">
        <em class="text-xs px-0.5">I</em>
      </button>
      <div class="flex-shrink-0 w-px h-5 mx-1 bg-gray-200"></div>
      <button type="button" @click="editor.chain().focus().toggleBulletList().run()"
              :class="btnClass(editor?.isActive('bulletList'))" title="Bullet List">
        <span class="text-xs px-0.5">• —</span>
      </button>
      <button type="button" @click="editor.chain().focus().toggleOrderedList().run()"
              :class="btnClass(editor?.isActive('orderedList'))" title="Ordered List">
        <span class="text-xs px-0.5">1.</span>
      </button>
      <div class="flex-shrink-0 w-px h-5 mx-1 bg-gray-200"></div>
      <button type="button" @click="setLink"
              :class="btnClass(editor?.isActive('link'))" title="Link">
        <span class="text-xs px-0.5">🔗</span>
      </button>
      <button type="button" @click="editor.chain().focus().unsetLink().run()"
              :disabled="!editor?.isActive('link')"
              class="p-1.5 rounded text-gray-400 hover:bg-gray-200 disabled:opacity-30 disabled:cursor-not-allowed transition-colors flex-shrink-0"
              title="Remove Link">
        <span class="text-xs px-0.5">✕🔗</span>
      </button>
      <div class="flex-shrink-0 w-px h-5 mx-1 bg-gray-200"></div>

      <!-- Table controls -->
      <button type="button" @click="insertTable"
              :class="btnClass(editor?.isActive('table'))" title="Insert Table">
        <span class="text-xs px-0.5">⊞ Table</span>
      </button>

      <!-- Table editing buttons - shown only when cursor is inside a table -->
      <template v-if="editor?.isActive('table')">
        <div class="flex-shrink-0 w-px h-5 mx-1 bg-gray-200"></div>
        <button type="button" @click="editor.chain().focus().addColumnAfter().run()"
                class="p-1.5 rounded text-gray-500 hover:bg-gray-200 transition-colors text-xs flex-shrink-0" title="Add Column">
          +Col
        </button>
        <button type="button" @click="editor.chain().focus().deleteColumn().run()"
                class="p-1.5 rounded text-gray-500 hover:bg-gray-200 transition-colors text-xs flex-shrink-0" title="Delete Column">
          -Col
        </button>
        <button type="button" @click="editor.chain().focus().addRowAfter().run()"
                class="p-1.5 rounded text-gray-500 hover:bg-gray-200 transition-colors text-xs flex-shrink-0" title="Add Row">
          +Row
        </button>
        <button type="button" @click="editor.chain().focus().deleteRow().run()"
                class="p-1.5 rounded text-gray-500 hover:bg-gray-200 transition-colors text-xs flex-shrink-0" title="Delete Row">
          -Row
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeaderRow().run()"
                class="p-1.5 rounded text-gray-500 hover:bg-gray-200 transition-colors text-xs flex-shrink-0" title="Toggle Header Row">
          Header
        </button>
        <button type="button" @click="editor.chain().focus().mergeOrSplit().run()"
                class="p-1.5 rounded text-gray-500 hover:bg-gray-200 transition-colors text-xs flex-shrink-0" title="Merge / Split Cell">
          Merge
        </button>
        <button type="button" @click="editor.chain().focus().deleteTable().run()"
                class="p-1.5 rounded text-red-400 hover:bg-red-50 transition-colors text-xs flex-shrink-0" title="Delete Table">
          ✕Table
        </button>
      </template>

      <div class="flex-shrink-0 w-px h-5 mx-1 bg-gray-200"></div>
      <button type="button" @click="editor.chain().focus().clearNodes().unsetAllMarks().run()"
              class="p-1.5 rounded text-gray-500 hover:bg-gray-200 transition-colors text-xs flex-shrink-0"
              title="Clear Formatting">
        Clear
      </button>
    </div>
    <!-- Editor -->
    <div class="min-h-[180px] sm:min-h-[200px]">
      <editor-content :editor="editor" class="aun-editor" />
    </div>
  </div>
</template>

<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Link from '@tiptap/extension-link'
import Placeholder from '@tiptap/extension-placeholder'
// import Table from '@tiptap/extension-table'
// import TableRow from '@tiptap/extension-table-row'
// import TableCell from '@tiptap/extension-table-cell'
// import TableHeader from '@tiptap/extension-table-header'
import { watch, onBeforeUnmount } from 'vue'
import { Table } from '@tiptap/extension-table'
import { TableRow } from '@tiptap/extension-table-row'
import { TableCell } from '@tiptap/extension-table-cell'
import { TableHeader } from '@tiptap/extension-table-header'

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
    Table.configure({
      resizable: true,
      HTMLAttributes: { class: 'aun-table' },
    }),
    TableRow,
    TableHeader,
    TableCell,
  ],
  onUpdate: ({ editor }) => emit('update:modelValue', editor.getHTML()),
})

watch(() => props.modelValue, (val) => {
  if (editor.value && editor.value.getHTML() !== val)
    editor.value.commands.setContent(val || '', false)
})

onBeforeUnmount(() => editor.value?.destroy())

function btnClass(isActive) {
  return ['p-1.5 rounded transition-colors flex-shrink-0',
    isActive ? 'bg-primary-100 text-primary-600' : 'text-gray-500 hover:bg-gray-200']
}

function setLink() {
  const prev = editor.value.getAttributes('link').href || ''
  const url  = window.prompt('URL:', prev)
  if (url === null) return
  if (url === '') { editor.value.chain().focus().unsetLink().run(); return }
  editor.value.chain().focus().setLink({ href: url }).run()
}

function insertTable() {
  editor.value.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run()
}
</script>

<style>
.aun-editor .ProseMirror {
  padding: 12px 16px; min-height: 180px; outline: none;
  font-size: 14px; line-height: 1.75; color: #374151;
}
@media (min-width: 640px) {
  .aun-editor .ProseMirror { min-height: 200px; }
}
.aun-editor .ProseMirror p { margin-bottom: 0.75rem; }
.aun-editor .ProseMirror ul, .aun-editor .ProseMirror ol { padding-left: 1.5rem; margin-bottom: 0.75rem; }
.aun-editor .ProseMirror li { margin-bottom: 0.25rem; }
.aun-editor .ProseMirror a { color: #185FA5; text-decoration: underline; word-break: break-word; }
.aun-editor .ProseMirror p.is-editor-empty:first-child::before {
  content: attr(data-placeholder); color: #9ca3af; pointer-events: none; float: left; height: 0;
}

/* ── Table styles (editor) ───────────────────────────────── */
.aun-editor .ProseMirror table {
  border-collapse: collapse;
  table-layout: fixed;
  width: 100%;
  margin: 0.75rem 0;
  overflow: hidden;
}
.aun-editor .ProseMirror td,
.aun-editor .ProseMirror th {
  min-width: 1em;
  border: 1px solid #d1d5db;
  padding: 6px 10px;
  vertical-align: top;
  box-sizing: border-box;
  position: relative;
}
.aun-editor .ProseMirror th {
  font-weight: 600;
  text-align: left;
  background-color: #f3f4f6;
}
.aun-editor .ProseMirror .selectedCell:after {
  z-index: 2;
  position: absolute;
  content: "";
  left: 0; right: 0; top: 0; bottom: 0;
  background: rgba(24, 95, 165, 0.08);
  pointer-events: none;
}
.aun-editor .ProseMirror .column-resize-handle {
  position: absolute;
  right: -2px; top: 0; bottom: -2px;
  width: 4px;
  background-color: #185FA5;
  pointer-events: none;
}
.aun-editor .ProseMirror.resize-cursor {
  cursor: col-resize;
}
/* Table styles สำหรับเนื้อหาที่ render จาก v-html */
:deep(.prose table) {
  border-collapse: collapse;
  width: 100%;
  table-layout: fixed;
  margin: 1rem 0;
  font-size: 0.875rem;
}
:deep(.prose td),
:deep(.prose th) {
  border: 1px solid #e5e7eb;
  padding: 8px 12px;
  text-align: left;
  vertical-align: top;
}
:deep(.prose th) {
  background-color: #f9fafb;
  font-weight: 600;
  color: #374151;
}
:deep(.prose tr:nth-child(even)) {
  background-color: #fafafa;
}
 
/* Mobile: ตารางเลื่อนแนวนอนได้ */
@media (max-width: 640px) {
  :deep(.prose table) {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }
}
</style>