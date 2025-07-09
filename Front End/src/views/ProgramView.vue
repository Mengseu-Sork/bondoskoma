<template>
  <div
    class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-purple-600"
  >
    <!-- Main Content -->
    <main class="min-h-screen bg-slate-50">
      <!-- Country Goal Section -->
      <section class="py-20 bg-gradient-to-br from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-6 md:px-10">
          <div>
                    <div class="text-center mb-20">
          <h2 class="text-5xl font-bold text-gray-900 mb-6">Our Country Goal</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Children and youths enjoy full potential of their rights in living with dignity to become human capital for sustainable development of the society.
          </p>
        </div>
            <div class="md:grid md:grid-cols-2">
              <!-- Left Side: Image -->
              <div class="h-64 md:h-full">
                <img
                  src="https://www.info-avec.org/wp-content/uploads/2019/12/scolarisation-parrainage-aide-scolaire-enfants-pauvre-cambodge-enfant-aide-humanitaire-enfance-abandon-ecole-volontaire-b%C3%A9n%C3%A9voles-mission-30-1536x1024.jpg"
                  alt="Children Education"
                  class="w-full h-full object-cover"
                />
              </div>

              <!-- Right Side: Text Content -->
              <div class="p-10 flex flex-col justify-center space-y-8">
                <div>
                  <h2
                    class="text-4xl font-extrabold text-slate-800 text-center md:text-left"
                  >
                    Bandos Komar
                  </h2>
                </div>

                <p
                  class="text-2xl font-semibold leading-relaxed text-center md:text-left bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent"
                >
                  By 2019, children and youths enjoy full potential of their
                  rights in living with dignity to become human capital for
                  sustainable development of the society.
                </p>

                <div
                  class="bg-slate-50 p-6 rounded-xl border-l-4 border-indigo-500 shadow"
                >
                  <h3 class="text-xl font-semibold text-slate-800 mb-2">
                    Goal Justification
                  </h3>
                  <p class="text-slate-600 leading-relaxed text-lg">
                    To enable children and youths to exercise their rights with
                    dignity, it is essential to provide them with quality and
                    equitable education so that they become agent of change of
                    their society. Bandos Komar is engaged to nurture and build
                    up human capital to tackle changes that will impact human
                    livelihoods.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Programs Section -->
      <section
        class="py-20 bg-gradient-to-br from-gray-50 to-gray-100 relative overflow-hidden"
      >
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
          <div
            class="absolute inset-0"
            style="
              background-image: radial-gradient(
                circle at 2px 2px,
                rgba(0, 0, 0, 0.15) 1px,
                transparent 0
              );
              background-size: 30px 30px;
            "
          ></div>
        </div>

        <div class="max-w-7xl mx-auto px-8 relative">
          <!-- Enhanced Header -->
          <div class="text-center mb-20">
            <h2
              class="text-3xl md:text-4xl font-bold mb-6 text-gray-800 tracking-wide"
            >
              OUR PROGRAMS FOR CHILDREN
            </h2>
            <div
              class="w-24 h-1 bg-gradient-to-r from-orange-400 to-blue-500 mx-auto rounded-full mb-6"
            ></div>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
              Empowering children and families through comprehensive support
              programs designed to create lasting positive change in communities
              across Cambodia.
            </p>
          </div>

          <!-- Enhanced Program Cards -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-16">
            <!-- Help to Mothers Card -->
            <div
              class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100"
            >
              <div class="relative overflow-hidden">
                <img
                  src="https://thislife.ngo/wp-content/uploads/2020/06/Website-banner-d38.jpg"
                  alt="Help to Mothers Program"
                  class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                />
                <!-- Gradient Overlay -->
                <div
                  class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"
                ></div>

                <button
                  class="absolute top-4 right-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  DONATE NOW
                </button>

                <!-- Program Badge -->
                <div
                  class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full"
                >
                  <span class="text-sm font-semibold text-gray-800"
                    >Maternal Care</span
                  >
                </div>
              </div>

              <div class="p-8">
                <h3
                  class="text-xl font-bold text-gray-800 mb-4 group-hover:text-blue-600 transition-colors duration-300"
                >
                  HELP TO MOTHERS
                </h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-sm">
                  We support mothers by providing access to essential services
                  such as maternal healthcare, nutrition, early childhood
                  education, and parenting training. We invest in the health and
                  future of the next generation.
                </p>

                <!-- Stats -->
                <div
                  class="flex justify-between items-center mb-6 p-3 bg-gray-50 rounded-lg"
                >
                  <div class="text-center">
                    <div class="text-lg font-bold text-blue-600">500+</div>
                    <div class="text-xs text-gray-500">Mothers Helped</div>
                  </div>
                  <div class="text-center">
                    <div class="text-lg font-bold text-green-600">15</div>
                    <div class="text-xs text-gray-500">Communities</div>
                  </div>
                </div>

                <button
                  @click="openModal('help-mothers')"
                  class="w-full bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  VIEW DETAILS
                </button>
              </div>
            </div>

            <!-- Child Support Card -->
            <div
              class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100"
            >
              <div class="relative overflow-hidden">
                <img
                  src="https://cambojanews.com/wp-content/uploads/2024/10/2024-10-21-19.06.28.jpg"
                  alt="Child Support Program"
                  class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                />
                <!-- Gradient Overlay -->
                <div
                  class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"
                ></div>

                <button
                  class="absolute top-4 right-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  DONATE NOW
                </button>

                <!-- Program Badge -->
                <div
                  class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full"
                >
                  <span class="text-sm font-semibold text-gray-800"
                    >Child Welfare</span
                  >
                </div>
              </div>

              <div class="p-8">
                <h3
                  class="text-xl font-bold text-gray-800 mb-4 group-hover:text-green-600 transition-colors duration-300"
                >
                  CHILD SUPPORT
                </h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-sm">
                  We are committed to ensuring that every child has the
                  opportunity to grow up in a safe, healthy, and supportive
                  environment. Our child support programs provide access to
                  education, healthcare, nutrition, and emotional care.
                </p>

                <!-- Stats -->
                <div
                  class="flex justify-between items-center mb-6 p-3 bg-gray-50 rounded-lg"
                >
                  <div class="text-center">
                    <div class="text-lg font-bold text-green-600">1,200+</div>
                    <div class="text-xs text-gray-500">Children Supported</div>
                  </div>
                  <div class="text-center">
                    <div class="text-lg font-bold text-purple-600">25</div>
                    <div class="text-xs text-gray-500">Programs</div>
                  </div>
                </div>

                <button
                  @click="openModal('child-support')"
                  class="w-full bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  VIEW DETAILS
                </button>
              </div>
            </div>

            <!-- New School Card -->
            <div
              class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100"
            >
              <div class="relative overflow-hidden">
                <img
                  src="https://cdn.businessday.ng/2020/03/UN0149769_4.jpg"
                  alt="New School Program"
                  class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                />
                <!-- Gradient Overlay -->
                <div
                  class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"
                ></div>

                <button
                  class="absolute top-4 right-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  DONATE NOW
                </button>

                <!-- Program Badge -->
                <div
                  class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full"
                >
                  <span class="text-sm font-semibold text-gray-800"
                    >Education</span
                  >
                </div>
              </div>

              <div class="p-8">
                <h3
                  class="text-xl font-bold text-gray-800 mb-4 group-hover:text-purple-600 transition-colors duration-300"
                >
                  NEW SCHOOL
                </h3>
                <p class="text-gray-600 mb-6 leading-relaxed text-sm">
                  Our new school initiative aims to expand access to quality
                  education for children in underserved communities. With safe
                  classrooms, trained teachers, and inclusive learning
                  materials, we provide a nurturing environment.
                </p>

                <!-- Stats -->
                <div
                  class="flex justify-between items-center mb-6 p-3 bg-gray-50 rounded-lg"
                >
                  <div class="text-center">
                    <div class="text-lg font-bold text-purple-600">8</div>
                    <div class="text-xs text-gray-500">New Schools</div>
                  </div>
                  <div class="text-center">
                    <div class="text-lg font-bold text-orange-600">800+</div>
                    <div class="text-xs text-gray-500">Students</div>
                  </div>
                </div>

                <button
                  @click="openModal('new-school')"
                  class="w-full bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  VIEW DETAILS
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Strategies Section -->
      <section class="py-20 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Section Header -->
          <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-800 mb-4">
              Our Key Strategies
            </h2>
            <p class="text-lg text-slate-600 max-w-3xl mx-auto">
              Comprehensive approaches to early childhood development and
              primary education enhancement
            </p>
          </div>

          <!-- ECCD Section -->
          <div class="mb-24">
            <div class="text-center mb-12">
              <h3 class="text-3xl font-bold text-slate-800 mb-3">
                Early Child Care & Development
              </h3>
              <div class="w-20 h-1 bg-blue-500 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
              <!-- Strategy Card 1 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://img.freepik.com/free-photo/still-life-business-roles-with-various-mechanism-pieces_23-2149352652.jpg?semt=ais_hybrid&w=740"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="Capacity Building"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Strengthening Local Partners
                  </h4>
                  <p class="text-slate-600">
                    Building capacity through child rights awareness, parent
                    education, improved teaching skills, and educational
                    resources.
                  </p>
                </div>
              </div>

              <!-- Strategy Card 2 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="Nutrition"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Improving Child Nutrition
                  </h4>
                  <p class="text-slate-600">
                    Combating malnutrition through integrated school meals and
                    parent education on home nutrition practices.
                  </p>
                </div>
              </div>

              <!-- Strategy Card 3 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="WASH"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Water, Sanitation & Hygiene
                  </h4>
                  <p class="text-slate-600">
                    Providing water and sanitation facilities with hygiene
                    education for healthier living conditions.
                  </p>
                </div>
              </div>

              <!-- Strategy Card 4 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="Community Health"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Community Health
                  </h4>
                  <p class="text-slate-600">
                    Promoting health education and better access to medical
                    services for families and children.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Primary Education Enhancement -->
          <div>
            <div class="text-center mb-12">
              <h3 class="text-3xl font-bold text-slate-800 mb-3">
                Primary Education Enhancement
              </h3>
              <div class="w-20 h-1 bg-blue-500 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
              <!-- Strategy Card 1 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://images.unsplash.com/photo-1588072432836-e10032774350?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="Friendly Schools"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Child-Friendly Schools
                  </h4>
                  <p class="text-slate-600">
                    Supporting inclusive environments through leadership
                    training, child protection awareness, and community
                    involvement.
                  </p>
                </div>
              </div>

              <!-- Strategy Card 2 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="Sanitation"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Water & Sanitation
                  </h4>
                  <p class="text-slate-600">
                    Installing clean water systems for drinking, washing, and
                    school gardening projects.
                  </p>
                </div>
              </div>

              <!-- Strategy Card 3 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="Reproductive Health"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Reproductive Health
                  </h4>
                  <p class="text-slate-600">
                    Teaching basic reproductive health with engaging materials
                    to help students make informed choices.
                  </p>
                </div>
              </div>

              <!-- Strategy Card 4 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="Life Skills"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Life Skills Promotion
                  </h4>
                  <p class="text-slate-600">
                    Equipping students with practical life skills and
                    entrepreneurial thinking for future success.
                  </p>
                </div>
              </div>

              <!-- Strategy Card 5 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="Climate"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Climate Resilience
                  </h4>
                  <p class="text-slate-600">
                    Integrating climate awareness and disaster reduction
                    practices into classroom activities.
                  </p>
                </div>
              </div>

              <!-- Strategy Card 6 -->
              <div
                class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100"
              >
                <div class="h-48 overflow-hidden">
                  <img
                    src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    alt="Partnership"
                    loading="lazy"
                  />
                </div>
                <div class="p-6">
                  <h4 class="text-xl font-semibold text-slate-800 mb-3">
                    Partnership Building
                  </h4>
                  <p class="text-slate-600">
                    Collaborating with stakeholders, NGOs, and education
                    networks to enhance and expand project impact.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Impact Section -->
      <section class="py-16 bg-white text-slate-800">
        <div class="max-w-6xl mx-auto px-8">
          <h2 class="text-4xl font-bold text-center mb-12 text-slate-800">
            Expected Impact
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div
              class="bg-white rounded-2xl p-8 text-center shadow-md border border-slate-200"
            >
              <div class="text-5xl font-bold mb-4 text-indigo-600">2019</div>
              <h4 class="text-xl font-semibold mb-4">Target Year</h4>
              <p class="leading-relaxed text-slate-600">
                Full implementation of all programs by 2019
              </p>
            </div>

            <!-- Card 2 -->
            <div
              class="bg-white rounded-2xl p-8 text-center shadow-md border border-slate-200"
            >
              <div class="text-5xl font-bold mb-4 text-indigo-600">6</div>
              <h4 class="text-xl font-semibold mb-4">Age Focus</h4>
              <p class="leading-relaxed text-slate-600">
                Children below 6 years old in target areas
              </p>
            </div>

            <!-- Card 3 -->
            <div
              class="bg-white rounded-2xl p-8 text-center shadow-md border border-slate-200"
            >
              <div class="text-5xl font-bold mb-4 text-indigo-600">100%</div>
              <h4 class="text-xl font-semibold mb-4">Coverage Goal</h4>
              <p class="leading-relaxed text-slate-600">
                Full potential and opportunity for all children
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Program Details Modal -->
    <div
      v-if="showModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
      @click="closeModal"
    >
      <div
        class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto"
        @click.stop
      >
        <div v-if="selectedProgram" class="relative">
          <!-- Modal Header -->
          <div class="relative">
            <img
              :src="selectedProgram.image"
              :alt="selectedProgram.title"
              class="w-full h-64 object-cover rounded-t-2xl"
            />
            <button
              @click="closeModal"
              class="absolute top-4 right-4 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 w-10 h-10 rounded-full flex items-center justify-center transition-all"
            >
              ✕
            </button>
            <div
              class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6"
            >
              <h2 class="text-3xl font-bold text-white">
                {{ selectedProgram.title }}
              </h2>
            </div>
          </div>

          <!-- Modal Content -->
          <div class="p-8">
            <!-- Description -->
            <div class="mb-8">
              <h3 class="text-2xl font-bold text-gray-800 mb-4">
                About This Program
              </h3>
              <p class="text-gray-600 leading-relaxed text-lg">
                {{ selectedProgram.fullDescription }}
              </p>
            </div>

            <!-- Goals -->
            <div class="mb-8">
              <h3 class="text-2xl font-bold text-gray-800 mb-4">
                Program Goals
              </h3>
              <ul class="space-y-3">
                <li
                  v-for="goal in selectedProgram.goals"
                  :key="goal"
                  class="flex items-start"
                >
                  <span class="text-teal-500 mr-3 mt-1">✓</span>
                  <span class="text-gray-600">{{ goal }}</span>
                </li>
              </ul>
            </div>

            <!-- Impact Statistics -->
            <div class="mb-8">
              <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Impact</h3>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-teal-50 p-6 rounded-xl text-center">
                  <div class="text-3xl font-bold text-teal-600 mb-2">
                    {{ selectedProgram.impact.beneficiaries }}
                  </div>
                  <div class="text-gray-600">Beneficiaries</div>
                </div>
                <div class="bg-yellow-50 p-6 rounded-xl text-center">
                  <div class="text-3xl font-bold text-yellow-600 mb-2">
                    {{ selectedProgram.impact.communities }}
                  </div>
                  <div class="text-gray-600">Communities</div>
                </div>
                <div class="bg-green-50 p-6 rounded-xl text-center">
                  <div class="text-3xl font-bold text-green-600 mb-2">
                    {{ selectedProgram.impact.successRate }}
                  </div>
                  <div class="text-gray-600">Success Rate</div>
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t">
              <button
                class="flex-1 bg-teal-500 hover:bg-teal-600 text-white px-8 py-4 rounded-lg font-semibold text-lg transition-colors"
              >
                DONATE TO THIS PROGRAM
              </button>
              <button
                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-4 rounded-lg font-semibold text-lg transition-colors"
              >
                LEARN MORE
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

// Modal state management
const showModal = ref(false);
const selectedProgram = ref<any>(null);

// Program data
const programs = [
  {
    id: "help-mothers",
    title: "HELP TO MOTHERS",
    image:
      "https://thislife.ngo/wp-content/uploads/2020/06/Website-banner-d38.jpg",
    shortDescription:
      "Supporting mothers with essential resources and education to create better futures for their families.",
    fullDescription:
      "Our Help to Mothers program focuses on empowering women through comprehensive support systems. We provide maternal health education, vocational training, and economic opportunities that enable mothers to become self-sufficient and create stable environments for their children.",
    goals: [
      "Improve maternal health outcomes",
      "Provide vocational training opportunities",
      "Support economic independence",
      "Strengthen family stability",
    ],
    impact: {
      beneficiaries: "2,500+ mothers",
      communities: "15 communities",
      successRate: "85%",
    },
  },
  {
    id: "child-support",
    title: "CHILD SUPPORT",
    image:
      "https://cambojanews.com/wp-content/uploads/2024/10/2024-10-21-19.06.28.jpg",
    shortDescription:
      "Comprehensive support for vulnerable children including nutrition, healthcare, and protection services.",
    fullDescription:
      "The Child Support program addresses the immediate and long-term needs of vulnerable children. We provide nutritional support, healthcare access, educational assistance, and protection services to ensure every child has the opportunity to thrive and reach their full potential.",
    goals: [
      "Ensure proper nutrition for all children",
      "Provide access to quality healthcare",
      "Protect children from abuse and exploitation",
      "Support educational development",
    ],
    impact: {
      beneficiaries: "5,000+ children",
      communities: "25 communities",
      successRate: "92%",
    },
  },
  {
    id: "new-school",
    title: "NEW SCHOOL",
    image: "https://cdn.businessday.ng/2020/03/UN0149769_4.jpg",
    shortDescription:
      "Building and establishing new educational facilities in underserved communities.",
    fullDescription:
      "The New School program focuses on expanding educational access by building modern, well-equipped schools in underserved areas. We ensure these facilities meet international standards and provide safe, conducive learning environments for children of all ages.",
    goals: [
      "Build modern educational facilities",
      "Provide quality learning environments",
      "Train qualified teaching staff",
      "Ensure sustainable school operations",
    ],
    impact: {
      beneficiaries: "3,200+ students",
      communities: "8 new schools built",
      successRate: "95%",
    },
  },
];

// Modal functions
const openModal = (programId: string) => {
  selectedProgram.value = programs.find((p) => p.id === programId);
  showModal.value = true;
  document.body.style.overflow = "hidden";
};

const closeModal = () => {
  showModal.value = false;
  selectedProgram.value = null;
  document.body.style.overflow = "auto";
};
</script>
