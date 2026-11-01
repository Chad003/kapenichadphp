<aside
   id="sidebar"
   :class="isSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
   class="w-72 max-w-[85vw] bg-white border-r border-slate-200 fixed inset-y-0 left-0 z-50 flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl lg:shadow-none">

   <div class="h-20 px-6 flex items-center border-b border-slate-100">
     <!-- Logo -->
     <div
       class="w-9 h-9 rounded-xl bg-slate-900 text-white flex items-center justify-center mr-3 shrink-0">
       <span class="font-bold">H</span>
     </div>

     <!-- HRMS Text -->
     <div class="min-w-0">
       <div class="font-semibold tracking-tight">ADMIN</div>
       <div class="text-[11px] text-slate-400">Management System</div>
     </div>

     <!-- Mobile Close Button -->
     <button
       onclick="closeSidebar"
       class="lg:hidden ml-3 w-10 h-10 shrink-0 flex items-center justify-center rounded-md text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition"
       aria-label="Close sidebar">
       <svg
         xmlns="http://www.w3.org/2000/svg"
         class="w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor"
         stroke-width="2">
         <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
       </svg>
     </button>
   </div>

   <div class="px-4 pt-5 pb-2">
     <p class="px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-400">
       Workspace
     </p>
   </div>

   <nav class="sidebar-scroll flex-1 overflow-y-auto px-4 pb-5 space-y-1">
     <button
       onclick="window.location.replace('/administration/dashboard')"
       data-section="Dashboard"
       class="nav-item active w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition text-left">
       <svg
         class="w-5 h-5 text-slate-500"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
         <path
           stroke-width="1.8"
           d="M3 13h8V3H3v10Zm10 8h8V11h-8v10ZM3 21h8v-6H3v6Zm10-10h8V3h-8v8Z" />
       </svg>
       Dashboard
     </button>

     <p
       class="px-3 pt-5 pb-2 text-[10px] font-semibold uppercase tracking-widest text-slate-400">
       People
     </p>

     <button
       onclick="window.location.replace('/administration/people/employees')"
       data-section="Employees"
       class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-100 transition text-left">
       <svg
         class="w-5 h-5 text-slate-500"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
         <path
           stroke-width="1.8"
           d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m9-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
       </svg>
       Employees
     </button>

     <button
       onclick="window.location.replace('/administration/people/departments-and-positions')"
       data-section="Departments"
       class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-100 transition text-left">
       <svg
         class="w-5 h-5 text-slate-500"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
         <path
           stroke-width="1.8"
           d="M3 21h18M5 21V5l7-3 7 3v16M9 9h2m-2 4h2m2-4h2m-2 4h2" />
       </svg>
       Departments & Positions
     </button>

     <button
       onclick="window.location.replace('/administration/people/recruitment')"
       data-section="Recruitment"
       class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-100 transition text-left">
       <svg
         class="w-5 h-5 text-slate-500"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
         <path
           stroke-width="1.8"
           d="M20 7h-4V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2ZM8 7h8" />
       </svg>
       Recruitment
     </button>

     <button
       onclick="window.location.replace('/administration/people/onboarding')"
       data-section="Onboarding"
       class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-100 transition text-left">
       <svg
         class="w-5 h-5 text-slate-500"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
         <path stroke-width="1.8" d="M5 12h14M12 5l7 7-7 7" />
       </svg>
       Onboarding
     </button>
     
     <p
       class="px-3 pt-5 pb-2 text-[10px] font-semibold uppercase tracking-widest text-slate-400">
       Administration
     </p>

     <button
       onclick="window.location.replace('/administration/user-and-roles')"
       data-section="Users & Roles"
       class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-100 transition text-left">
       <svg
         class="w-5 h-5 text-slate-500"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
         <path
           stroke-width="1.8"
           d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm7.4-3a7.5 7.5 0 0 0-.1-1l2-1.55-2-3.46-2.35.95a7.5 7.5 0 0 0-1.75-1L14.85 3h-4l-.35 2.94a7.5 7.5 0 0 0-1.75 1L6.4 5.99l-2 3.46 2 1.55a7.5 7.5 0 0 0 0 2l-2 1.55 2 3.46 2.35-.95a7.5 7.5 0 0 0 1.75 1L10.85 21h4l.35-2.94a7.5 7.5 0 0 0 1.75-1l2.35.95 2-3.46-2-1.55c.07-.32.1-.66.1-1Z" />
       </svg>
       Users & Roles
     </button>

     <button
       onclick="window.location.replace('/administration/audit-logs')"
       data-section="Audit Logs"
       class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-100 transition text-left">
       <svg
         class="w-5 h-5 text-slate-500"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
         <path stroke-width="1.8" d="M7 3h10v18H7zM9 7h6m-6 4h6m-6 4h4" />
       </svg>
       Audit Logs
     </button>

     <button
       onclick="window.location.replace('/administration/settings')"
       data-section="Settings"
       class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-slate-100 transition text-left">
       <svg
         class="w-5 h-5 text-slate-500"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
         <path
           stroke-width="1.8"
           d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm7.4-3a7.5 7.5 0 0 0-.1-1l2-1.55-2-3.46-2.35.95a7.5 7.5 0 0 0-1.75-1L14.85 3h-4l-.35 2.94a7.5 7.5 0 0 0-1.75 1L6.4 5.99l-2 3.46 2 1.55a7.5 7.5 0 0 0 0 2l-2 1.55 2 3.46 2.35-.95a7.5 7.5 0 0 0 1.75 1L10.85 21h4l.35-2.94a7.5 7.5 0 0 0 1.75-1l2.35.95 2-3.46-2-1.55c.07-.32.1-.66.1-1Z" />
       </svg>
       Settings
     </button>
   </nav>

   <div class="p-4 border-t border-slate-100">
     <div
       class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 cursor-pointer">
       <div
         class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-xs font-semibold">
         WF
       </div>
       <div class="min-w-0">
         <div class="text-sm font-medium truncate">Juan Dela Paz</div>
         <div class="text-[11px] text-slate-400 truncate">Administrator</div>
       </div>
       <svg
         class="w-4 h-4 ml-auto text-slate-400"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">
         <path stroke-width="1.8" d="m9 18 6-6-6-6" />
       </svg>
     </div>
   </div>
 </aside>