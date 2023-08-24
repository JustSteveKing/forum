<script setup lang="ts">
import axios from "axios";
import { Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import {
  ArrowTrendingUpIcon,
  Bars3Icon,
  BellIcon,
  FireIcon,
  HomeIcon,
  UserGroupIcon,
  XMarkIcon,
} from '@heroicons/vue/24/outline'
import {usePage, Link} from "@inertiajs/vue3";
import { computed, ref } from 'vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { ChevronRightIcon, UsersIcon } from '@heroicons/vue/24/outline'
import {
  Combobox,
  ComboboxInput,
  ComboboxOptions,
  ComboboxOption,
  Dialog,
  DialogPanel,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'

const people = [
  {
    id: 1,
    name: 'Leslie Alexander',
    phone: '1-493-747-9031',
    email: 'lesliealexander@example.com',
    role: 'Co-Founder / CEO',
    url: 'https://example.com',
    profileUrl: '#',
    imageUrl:
        'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
  },
  // More people...
]

const fetchResults = async (search: string) => {
  const { data } = await axios.get(route('search'), {
    params: {
      search: search,
    }
  })

  console.log(data)

  return data
}

const search = ref(false)
const query = ref('')

const results = (query: string) => {
  return fetchResults(query)
}

const filteredResults = computed(() =>
    query.value === ''
        ? []
        : results(query.value)
)

function onSelect(person) {
  window.location = person.url
}

const user = usePage().props.auth.user

const navigation = [
  { name: 'Home', href: '#', icon: HomeIcon, current: true },
  { name: 'Popular', href: '#', icon: FireIcon, current: false },
  { name: 'Communities', href: '#', icon: UserGroupIcon, current: false },
  { name: 'Trending', href: '#', icon: ArrowTrendingUpIcon, current: false },
]

const userNavigation = [
  { name: 'Your Profile', href: '#' },
  { name: 'Settings', href: route('profile.edit') },
  { name: 'Sign out', href: '#' },
]
</script>

<template>
  <div class="min-h-full">

    <Popover as="template" v-slot="{ open }">
      <header
        :class="[open ? 'fixed inset-0 z-40 overflow-y-auto' : '', 'bg-white shadow-sm lg:static lg:overflow-y-visible']">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="relative flex justify-between lg:gap-8 xl:grid xl:grid-cols-12">
            <div class="flex md:absolute md:inset-y-0 md:left-0 lg:static xl:col-span-2">
              <div class="flex flex-shrink-0 items-center">
                <Link :href="route('home')" class="text-indigo-400">
                  <svg class="block h-8 w-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"></path>
                  </svg>
                </Link>
              </div>
            </div>
            <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-6">
              <div class="flex items-center px-6 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0">
                <div class="w-full">
                  <label for="search" class="sr-only">Search</label>
                  <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                      <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                    </div>
                    <input id="search" name="search"
                           class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6"
                           placeholder="Search" type="search"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex items-center md:absolute md:inset-y-0 md:right-0 lg:hidden">
              <!-- Mobile menu button -->
              <PopoverButton
                class="relative -mx-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-rose-500">
                <span class="absolute -inset-0.5"/>
                <span class="sr-only">Open menu</span>
                <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true"/>
                <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true"/>
              </PopoverButton>
            </div>
            <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">
              <!-- Profile dropdown -->
              <template v-if="user">
                <a href="#"
                   class="ml-5 flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                  <span class="sr-only">View notifications</span>
                  <BellIcon class="h-6 w-6" aria-hidden="true"/>
                </a>

                <Menu as="div" class="relative ml-5 flex-shrink-0">
                  <div>
                    <MenuButton
                        class="relative flex rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                      <span class="absolute -inset-1.5"/>
                      <span class="sr-only">Open user menu</span>
                      <img class="h-8 w-8 rounded-full" :src="user.avatar" alt=""/>
                    </MenuButton>
                  </div>
                  <transition enter-active-class="transition ease-out duration-100"
                              enter-from-class="transform opacity-0 scale-95"
                              enter-to-class="transform opacity-100 scale-100"
                              leave-active-class="transition ease-in duration-75"
                              leave-from-class="transform opacity-100 scale-100"
                              leave-to-class="transform opacity-0 scale-95">
                    <MenuItems
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                      <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                        <a :href="item.href"
                           :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{
                            item.name
                          }}</a>
                      </MenuItem>
                    </MenuItems>
                  </transition>
                </Menu>

                <a href="#" class="ml-6 inline-flex items-center rounded-md bg-rose-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600">
                  New Discussion
                </a>
              </template>
              <template v-else>
                <div class="space-x-8">
                  <Link :href="route('login')">Sign In</Link>
                  <Link :href="route('register')">Register</Link>
                </div>
              </template>

            </div>
          </div>
        </div>

        <PopoverPanel as="nav" class="lg:hidden" aria-label="Global">
          <div class="mx-auto max-w-3xl space-y-1 px-2 pb-3 pt-2 sm:px-4">
            <a v-for="item in navigation" :key="item.name" :href="item.href"
               :aria-current="item.current ? 'page' : undefined"
               :class="[item.current ? 'bg-gray-100 text-gray-900' : 'hover:bg-gray-50', 'block rounded-md py-2 px-3 text-base font-medium']">{{
                item.name
              }}</a>
          </div>
          <div class="border-t border-gray-200 pt-4">
            <div class="mx-auto flex max-w-3xl items-center px-4 sm:px-6">
              <div class="flex-shrink-0">
                <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt=""/>
              </div>
              <div class="ml-3">
                <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
              </div>
              <button type="button"
                      class="relative ml-auto flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                <span class="absolute -inset-1.5"/>
                <span class="sr-only">View notifications</span>
                <BellIcon class="h-6 w-6" aria-hidden="true"/>
              </button>
            </div>
            <div class="mx-auto mt-3 max-w-3xl space-y-1 px-2 sm:px-4">
              <a v-for="item in userNavigation" :key="item.name" :href="item.href"
                 class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">{{
                  item.name
                }}</a>
            </div>
          </div>

          <div class="mx-auto mt-6 max-w-3xl px-4 sm:px-6">
            <a href="#"
               class="flex w-full items-center justify-center rounded-md border border-transparent bg-rose-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-rose-700">New
              Post</a>

            <div class="mt-6 flex justify-center">
              <a href="#" class="text-base font-medium text-gray-900 hover:underline">Go Premium</a>
            </div>
          </div>
        </PopoverPanel>
      </header>
    </Popover>

    <TransitionRoot :show="search" as="template" @after-leave="query = ''" appear>
      <Dialog as="div" class="relative z-10" @close="search = false">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity" />
        </TransitionChild>

        <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 md:p-20">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="ease-in duration-200" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
            <DialogPanel class="mx-auto max-w-3xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
              <Combobox v-slot="{ activeOption }" @update:modelValue="onSelect">
                <div class="relative">
                  <MagnifyingGlassIcon class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                  <ComboboxInput class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm" placeholder="Search..." @change="query = $event.target.value" />
                </div>

                <ComboboxOptions
                    class="flex divide-x divide-gray-100" as="div"
                    :hold="true"
                >
                  <div :class="['max-h-96 min-w-0 flex-auto scroll-py-4 overflow-y-auto px-6 py-4', activeOption && 'sm:h-96']">
                    <div class="-mx-2 text-sm text-gray-700">
                      <ComboboxOption
                          v-for="(result, index) in filteredResults"
                          :key="index"
                          :value="result"
                          as="template"
                          v-slot="{ active }"
                      >
                        <div :class="['group flex cursor-default select-none items-center rounded-md p-2', active && 'bg-gray-100 text-gray-900']">
                          <span class="ml-3 flex-auto truncate">{{ result.title }}</span>
                          <ChevronRightIcon v-if="active" class="ml-3 h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
                        </div>
                      </ComboboxOption>
                    </div>
                  </div>

                  <div v-if="activeOption" class="hidden h-96 w-1/2 flex-none flex-col divide-y divide-gray-100 overflow-y-auto sm:flex">
                    <div class="flex-none p-6 text-center">
                      <img :src="activeOption.imageUrl" alt="" class="mx-auto h-16 w-16 rounded-full" />
                      <h2 class="mt-3 font-semibold text-gray-900">
                        {{ activeOption.name }}
                      </h2>
                      <p class="text-sm leading-6 text-gray-500">{{ activeOption.role }}</p>
                    </div>
                    <div class="flex flex-auto flex-col justify-between p-6">
                      <dl class="grid grid-cols-1 gap-x-6 gap-y-3 text-sm text-gray-700">
                        <dt class="col-end-1 font-semibold text-gray-900">Phone</dt>
                        <dd>{{ activeOption.phone }}</dd>
                        <dt class="col-end-1 font-semibold text-gray-900">URL</dt>
                        <dd class="truncate">
                          <a :href="activeOption.url" class="text-indigo-600 underline">
                            {{ activeOption.url }}
                          </a>
                        </dd>
                        <dt class="col-end-1 font-semibold text-gray-900">Email</dt>
                        <dd class="truncate">
                          <a :href="`mailto:${activeOption.email}`" class="text-indigo-600 underline">
                            {{ activeOption.email }}
                          </a>
                        </dd>
                      </dl>
                      <button type="button" class="mt-6 w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send message</button>
                    </div>
                  </div>
                </ComboboxOptions>

                <div v-if="query !== '' && filteredResults === 0" class="px-6 py-14 text-center text-sm sm:px-14">
                  <UsersIcon class="mx-auto h-6 w-6 text-gray-400" aria-hidden="true" />
                  <p class="mt-4 font-semibold text-gray-900">No people found</p>
                  <p class="mt-2 text-gray-500">We couldn’t find anything with that term. Please try again.</p>
                </div>

              </Combobox>
            </DialogPanel>
          </TransitionChild>
        </div>
      </Dialog>
    </TransitionRoot>

    <div class="py-10">
      <div class="mx-auto max-w-3xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-12 lg:gap-8 lg:px-8">
        <div class="hidden lg:col-span-3 lg:block xl:col-span-2">
          <slot name="sidenav" />
        </div>

        <main class="lg:col-span-9 xl:col-span-6">
          <slot />
        </main>

        <aside class="hidden xl:col-span-4 xl:block">
          <slot name="sidebar" />
        </aside>
      </div>
    </div>
  </div>
</template>
