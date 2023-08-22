<script setup lang="ts">
import {ref} from 'vue'
import {RadioGroup, RadioGroupLabel, RadioGroupOption} from '@headlessui/vue'
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {Link, useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";

const avatarOptions = [
  {name: 'GitHub', path: 'https://unavatar.io/github/'},
  {name: 'Substack', path: 'https://unavatar.io/substack/'},
  {name: 'Telegram', path: 'https://unavatar.io/telegram/'},
  {name: 'Twitter', path: 'https://unavatar.io/twitter/'},
  {name: 'YouTube', path: 'https://unavatar.io/youtube/'},
]

const source = ref(avatarOptions[2])

const form = useForm({
  key: '',
  avatar: '',
});

const submit = async () => {
    form.avatar = `${source.path}${form.key}`

    form.patch(route('profile.update'))
}
</script>

<template>
  <section class="flex items-center justify-center">
    <div>
      <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
          Profile Avatar
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
          Choose the avatar option for your profile.
        </p>
      </header>

      <form @submit.prevent="submit" class="mt-6 space-y-6">
        <div>
          <InputLabel for="key" value="Key"/>

          <TextInput
              id="key"
              type="text"
              class="mt-1 block w-full"
              v-model="form.key"
              required
          />

          <InputError class="mt-2" :message="form.errors.key"/>
        </div>

        <div>
          <RadioGroup v-model="source" class="mt-2">
            <RadioGroupLabel class="sr-only">Choose an avatar option</RadioGroupLabel>
            <div class="grid grid-cols-3 gap-3 sm:grid-cols-6">
              <RadioGroupOption as="template" v-for="option in avatarOptions" :key="option.name" :value="option"
                                v-slot="{ active, checked }">
                <div
                    :class="[
                      active ? 'ring-2 ring-indigo-600 ring-offset-2' : '',
                      checked ? 'bg-indigo-600 text-white hover:bg-indigo-500' : 'ring-1 ring-inset ring-gray-300 bg-white text-gray-900 hover:bg-gray-50',
                      'cursor-pointer focus:outline-none flex items-center justify-center rounded-md py-3 px-3 text-sm font-semibold uppercase sm:flex-1'
                  ]"
                >
                  <RadioGroupLabel as="span">{{ option.name }}</RadioGroupLabel>
                </div>
              </RadioGroupOption>
            </div>
          </RadioGroup>
        </div>

        <div class="flex items-center gap-4">
          <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

          <Transition
              enter-active-class="transition ease-in-out"
              enter-from-class="opacity-0"
              leave-active-class="transition ease-in-out"
              leave-to-class="opacity-0"
          >
            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
          </Transition>
        </div>
      </form>
    </div>
    <div class="p-4">
      <img :src="`${source.path}${form.key}`"/>
    </div>
  </section>
</template>
