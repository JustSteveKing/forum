<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

defineProps<{
  canResetPassword?: boolean;
  status?: string;
}>();

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => {
      form.reset('password');
    },
  });
};
</script>

<template>
  <GuestLayout message="Sign in to your account">
    <Head title="Sign in"/>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
      <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
        <form class="space-y-6" v-on:submit.prevent="submit">
          <div>
            <InputLabel for="email" value="Email"/>
            <div class="mt-2">
              <TextInput
                  id="email"
                  type="email"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  v-model="form.email"
                  required
                  autofocus
              />

              <InputError class="mt-2" :message="form.errors.email"/>
            </div>
          </div>

          <div>
            <InputLabel for="password" value="Password"/>
            <div class="mt-2">
              <TextInput
                  id="password"
                  type="password"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                  v-model="form.password"
                  required
                  autocomplete="current-password"
              />

              <InputError class="mt-2" :message="form.errors.password"/>
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <label class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember"
                          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"/>
                <span class="ml-3 block text-sm leading-6 text-gray-900">Remember me</span>
              </label>
            </div>

            <div class="text-sm leading-6">
              <Link
                  :href="route('password.request')"
                  class="font-semibold text-indigo-600 hover:text-indigo-500"
              >
                Forgot your password?
              </Link>
            </div>
          </div>

          <div>
            <PrimaryButton
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
              Sign In
            </PrimaryButton>
          </div>
        </form>

        <div>
          <div class="relative mt-10">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
              <div class="w-full border-t border-gray-200"/>
            </div>
            <div class="relative flex justify-center text-sm font-medium leading-6">
              <span class="bg-white px-6 text-gray-900">Or continue with</span>
            </div>
          </div>

          <div class="mt-6 grid grid-cols-1 gap-4">

            <a :href="route('auth:github:redirect')"
               class="flex w-full items-center justify-center gap-3 rounded-md bg-[#24292F] px-3 py-1.5 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#24292F]">
              <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z"
                      clip-rule="evenodd"/>
              </svg>
              <span class="text-sm font-semibold leading-6">GitHub</span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <p class="mt-10 text-center text-sm text-gray-500">
      No Account?
      {{ ' ' }}
      <Link :href="route('register')" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
        Create a new Account
      </Link>
    </p>
  </GuestLayout>
</template>
