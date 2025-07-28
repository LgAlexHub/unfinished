<template>
    <div class="inline-flex items-center">
        <div @click="toggle" :class="[
            'relative flex items-center justify-center cursor-pointer transition-all duration-200 ease-in-out border-2 rounded-md',
            size === 'sm' ? 'w-4 h-4' : size === 'lg' ? 'w-7 h-7' : 'w-5 h-5',
            isChecked
                ? 'bg-blue-600 border-blue-600 hover:bg-blue-700 hover:border-blue-700'
                : 'bg-white border-gray-300 hover:border-gray-400',
            disabled ? 'opacity-50 cursor-not-allowed' : ''
        ]" :aria-checked="isChecked" :aria-disabled="disabled" role="checkbox" tabindex="0"
            @keydown.space.prevent="toggle" @keydown.enter.prevent="toggle">
            <svg v-show="isChecked" :class="[
                'text-white transition-opacity duration-150',
                size === 'sm' ? 'w-2.5 h-2.5' : size === 'lg' ? 'w-4 h-4' : 'w-3 h-3'
            ]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <label v-if="label" @click="toggle" :class="[
            'ml-2 cursor-pointer select-none text-gray-700',
            size === 'sm' ? 'text-sm' : size === 'lg' ? 'text-lg' : 'text-base',
            disabled ? 'opacity-50 cursor-not-allowed' : 'hover:text-gray-900'
        ]">
            {{ label }}
        </label>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false
    },
    label: {
        type: String,
        default: ''
    },
    disabled: {
        type: Boolean,
        default: false
    },
    size: {
        type: String,
        default: 'md',
        validator: (value:string) => ['sm', 'md', 'lg'].includes(value)
    }
})

const emit = defineEmits(['update:modelValue', 'change'])

const isChecked = computed(() => props.modelValue)

const toggle = () => {
    if (props.disabled) return

    const newValue = !props.modelValue
    emit('update:modelValue', newValue)
    emit('change', newValue)
}
</script>