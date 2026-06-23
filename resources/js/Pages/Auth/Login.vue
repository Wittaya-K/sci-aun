<template>
  <Head title="เข้าสู่ระบบ" />

  <div class="wrapper">

    <!-- Left panel with inline SVG background -->
    <div class="left-panel">
      <div class="left-bg">
        <svg width="100%" height="100%" viewBox="0 0 800 900" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
          <!-- Sky gradient -->
          <defs>
            <linearGradient id="skyGrad" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#04111f"/>
              <stop offset="60%" stop-color="#0a1e3d"/>
              <stop offset="100%" stop-color="#0d2a50"/>
            </linearGradient>
            <linearGradient id="seaGrad" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#0d2a50"/>
              <stop offset="100%" stop-color="#071528"/>
            </linearGradient>
            <radialGradient id="moonGlow" cx="50%" cy="50%" r="50%">
              <stop offset="0%" stop-color="#c9a84c" stop-opacity="0.18"/>
              <stop offset="100%" stop-color="#c9a84c" stop-opacity="0"/>
            </radialGradient>
          </defs>

          <!-- Sky -->
          <rect width="800" height="900" fill="url(#skyGrad)"/>

          <!-- Moon glow halo -->
          <ellipse cx="600" cy="160" rx="120" ry="120" fill="url(#moonGlow)"/>

          <!-- Moon -->
          <circle cx="600" cy="160" r="38" fill="#e8c97a" opacity="0.9"/>
          <circle cx="614" cy="150" r="32" fill="#0a1e3d"/>

          <!-- Stars -->
          <g fill="#e8c97a" opacity="0.7">
            <circle cx="80"  cy="60"  r="1.2"/>
            <circle cx="160" cy="30"  r="0.9"/>
            <circle cx="240" cy="80"  r="1.4"/>
            <circle cx="320" cy="40"  r="0.8"/>
            <circle cx="420" cy="90"  r="1.1"/>
            <circle cx="500" cy="25"  r="1.3"/>
            <circle cx="680" cy="55"  r="0.9"/>
            <circle cx="730" cy="100" r="1.2"/>
            <circle cx="50"  cy="130" r="0.8"/>
            <circle cx="190" cy="150" r="1.0"/>
            <circle cx="350" cy="120" r="0.9"/>
            <circle cx="470" cy="200" r="0.7"/>
            <circle cx="110" cy="220" r="1.1"/>
            <circle cx="650" cy="220" r="0.8"/>
            <circle cx="760" cy="180" r="1.0"/>
            <circle cx="270" cy="200" r="0.6"/>
            <circle cx="540" cy="140" r="0.9"/>
          </g>

          <!-- PSU Building silhouette -->
          <!-- Main building body -->
          <rect x="180" y="480" width="440" height="260" fill="#071020"/>
          <!-- Roof ridge -->
          <polygon points="180,480 400,380 620,480" fill="#071828"/>
          <!-- Dome -->
          <ellipse cx="400" cy="390" rx="55" ry="38" fill="#0a1f36"/>
          <!-- Dome peak -->
          <polygon points="395,352 400,330 405,352" fill="#c9a84c" opacity="0.8"/>

          <!-- Windows - row 1 -->
          <g fill="#c9a84c" opacity="0.35">
            <rect x="220" y="520" width="28" height="38" rx="3"/>
            <rect x="270" y="520" width="28" height="38" rx="3"/>
            <rect x="320" y="520" width="28" height="38" rx="3"/>
            <rect x="430" y="520" width="28" height="38" rx="3"/>
            <rect x="480" y="520" width="28" height="38" rx="3"/>
            <rect x="530" y="520" width="28" height="38" rx="3"/>
          </g>
          <!-- Windows - row 2 -->
          <g fill="#c9a84c" opacity="0.25">
            <rect x="220" y="580" width="28" height="38" rx="3"/>
            <rect x="270" y="580" width="28" height="38" rx="3"/>
            <rect x="320" y="580" width="28" height="38" rx="3"/>
            <rect x="430" y="580" width="28" height="38" rx="3"/>
            <rect x="480" y="580" width="28" height="38" rx="3"/>
            <rect x="530" y="580" width="28" height="38" rx="3"/>
          </g>
          <!-- Center door arch -->
          <rect x="375" y="650" width="50" height="90" rx="25" fill="#c9a84c" opacity="0.2"/>

          <!-- Columns -->
          <g fill="#060e1c">
            <rect x="230" y="480" width="18" height="260"/>
            <rect x="310" y="480" width="18" height="260"/>
            <rect x="472" y="480" width="18" height="260"/>
            <rect x="552" y="480" width="18" height="260"/>
          </g>

          <!-- Steps -->
          <rect x="150" y="740" width="500" height="14" rx="2" fill="#060e1c"/>
          <rect x="130" y="754" width="540" height="12" rx="2" fill="#050d1a"/>
          <rect x="100" y="766" width="600" height="12" rx="2" fill="#040b17"/>

          <!-- Sea -->
          <rect x="0" y="778" width="800" height="122" fill="url(#seaGrad)"/>

          <!-- Sea reflection shimmer -->
          <g fill="#c9a84c" opacity="0.08">
            <ellipse cx="400" cy="800" rx="180" ry="6"/>
            <ellipse cx="400" cy="820" rx="120" ry="4"/>
            <ellipse cx="600" cy="810" rx="80"  ry="3"/>
            <ellipse cx="600" cy="830" rx="50"  ry="2"/>
          </g>

          <!-- Sea waves -->
          <g stroke="#1a4a7a" stroke-width="1" fill="none" opacity="0.5">
            <path d="M0 800 Q100 795 200 800 Q300 805 400 800 Q500 795 600 800 Q700 805 800 800"/>
            <path d="M0 820 Q100 815 200 820 Q300 825 400 820 Q500 815 600 820 Q700 825 800 820"/>
            <path d="M0 840 Q100 835 200 840 Q300 845 400 840 Q500 835 600 840 Q700 845 800 840"/>
          </g>

          <!-- Overlay gradient for text readability -->
          <rect width="800" height="900" fill="url(#skyGrad)" opacity="0.45"/>

          <!-- Palm tree left -->
          <line x1="100" y1="780" x2="115" y2="550" stroke="#040b17" stroke-width="8"/>
          <ellipse cx="100" cy="548" rx="55" ry="22" fill="#040b17" transform="rotate(-15,100,548)"/>
          <ellipse cx="130" cy="540" rx="50" ry="18" fill="#040b17" transform="rotate(20,130,540)"/>
          <ellipse cx="85"  cy="535" rx="45" ry="16" fill="#040b17" transform="rotate(-30,85,535)"/>

          <!-- Palm tree right -->
          <line x1="690" y1="780" x2="678" y2="560" stroke="#040b17" stroke-width="8"/>
          <ellipse cx="692" cy="558" rx="55" ry="22" fill="#040b17" transform="rotate(15,692,558)"/>
          <ellipse cx="660" cy="550" rx="50" ry="18" fill="#040b17" transform="rotate(-20,660,550)"/>
          <ellipse cx="710" cy="545" rx="45" ry="16" fill="#040b17" transform="rotate(30,710,545)"/>
        </svg>
      </div>

      <div class="left-overlay">
        <div class="left-content">
          <div class="university-badge">
            <div class="badge-dot">⚓</div>
            <span class="badge-text">Prince of Songkla University</span>
          </div>
          <h1 class="left-title">
            ระบบจัดการ<br>
            หลักฐาน <span>AUN-QA</span>
          </h1>
          <p class="left-subtitle">
            ระบบจัดการหลักฐานคุณภาพหลักสูตรตามเกณฑ์ AUN-QA<br>
            คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์
          </p>
          <div class="stats-row">
            <div class="stat">
              <div class="stat-num">AUN</div>
              <div class="stat-label">QA CRITERIA</div>
            </div>
            <div class="stat">
              <div class="stat-num">2026</div>
              <div class="stat-label">ACADEMIC YEAR</div>
            </div>
            <div class="stat">
              <div class="stat-num">PSU</div>
              <div class="stat-label">FACULTY OF SCIENCE</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right panel -->
    <div class="right-panel">
      <div class="top-stripe"></div>

      <div class="particles">
        <div v-for="p in particles" :key="p.id" class="particle"
             :style="{ left: p.left, width: p.size, height: p.size, animationDuration: p.duration, animationDelay: p.delay }"/>
      </div>

      <div class="right-inner">
        <div class="logo-area">
          <div class="logo-icon">🏛️</div>
          <div class="logo-title">AUN-QA Evidence</div>
          <div class="logo-sub">Faculty of Science · PSU</div>
        </div>

        <div class="login-card">
          <div class="greeting">Welcome Back</div>
          <h2 class="heading">เข้าสู่ระบบ</h2>
          <p class="sub-heading">กรุณาใส่ข้อมูลเพื่อเข้าใช้งาน</p>

          <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">ADMIN</span>
            <div class="divider-line"></div>
          </div>

          <div v-if="status" class="status-msg">{{ status }}</div>

          <form @submit.prevent="submit" style="width:100%">
            <div class="field">
              <label class="field-label">อีเมล</label>
              <input v-model="form.email" type="email" required autofocus autocomplete="username"
                     placeholder="username@psu.ac.th" class="field-input"
                     :class="{ 'field-input--error': form.errors.email }"/>
              <p v-if="form.errors.email" class="field-error">{{ form.errors.email }}</p>
            </div>

            <div class="field">
              <label class="field-label">รหัสผ่าน</label>
              <div style="position:relative">
                <input v-model="form.password" :type="showPassword ? 'text' : 'password'"
                       required autocomplete="current-password"
                       placeholder="••••••••" class="field-input"
                       :class="{ 'field-input--error': form.errors.password }"/>
                <button type="button" @click="showPassword = !showPassword" class="eye-btn">
                  {{ showPassword ? '🙈' : '👁️' }}
                </button>
              </div>
              <p v-if="form.errors.password" class="field-error">{{ form.errors.password }}</p>
            </div>

            <div class="remember-row">
              <label class="remember-label">
                <input v-model="form.remember" type="checkbox" class="remember-check"/>
                จดจำการเข้าสู่ระบบ
              </label>
            </div>

            <button type="submit" :disabled="form.processing" class="btn-login">
              <svg v-if="form.processing" class="spin" fill="none" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
                <circle style="opacity:.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path style="opacity:.75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
              </svg>
              {{ form.processing ? 'กำลังเข้าสู่ระบบ...' : 'เข้าสู่ระบบ' }}
            </button>
          </form>

          <p class="btn-note">สำหรับ <span>ผู้ดูแลระบบ</span> เท่านั้น</p>
        </div>

        <div class="contact-section">
          <div class="contact-label">ติดต่อสอบถาม</div>
          <div class="contact-items">
            <div class="contact-item"><div class="contact-item-icon">📞</div><span>0-7428-8620</span></div>
            <div class="contact-item"><div class="contact-item-icon">✉️</div><span>wittaya.kh@psu.ac.th</span></div>
            <div class="contact-item"><div class="contact-item-icon">🏢</div><span>คณะวิทยาศาสตร์ มหาวิทยาลัยสงขลานครินทร์</span></div>
          </div>
        </div>

        <div style="text-align:center;margin-top:20px">
          <a :href="route('aun.show', 1)" class="back-link">← กลับหน้าสาธารณะ</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'

defineProps({ canResetPassword: Boolean, status: String })

const showPassword = ref(false)
const form = useForm({ email: '', password: '', remember: false })

function submit() {
  form.post(route('login'), { onFinish: () => form.reset('password') })
}

const particles = Array.from({ length: 18 }, (_, i) => ({
  id: i,
  left: Math.random() * 100 + '%',
  size: (Math.random() * 3 + 1) + 'px',
  duration: (Math.random() * 15 + 10) + 's',
  delay: (Math.random() * 10) + 's',
}))
</script>

<style scoped>
.wrapper { min-height: 100vh; display: flex; overflow: hidden; font-family: 'Sarabun', sans-serif; background: #0a1628; }

.left-panel { flex: 1; position: relative; overflow: hidden; }
.left-bg { position: absolute; inset: 0; }
.left-bg svg { width: 100%; height: 100%; }

.left-overlay {
  position: absolute; inset: 0; z-index: 2;
  display: flex; flex-direction: column; justify-content: flex-end; padding: 60px;
  background: linear-gradient(135deg, rgba(4,17,31,0.5) 0%, transparent 50%, rgba(4,17,31,0.7) 100%);
}
.left-content { position: relative; z-index: 1; }

.university-badge {
  display: inline-flex; align-items: center; gap: 12px;
  background: rgba(201,168,76,0.15); border: 1px solid rgba(201,168,76,0.2);
  border-radius: 40px; padding: 8px 20px 8px 8px; margin-bottom: 32px;
  backdrop-filter: blur(8px);
}
.badge-dot { width: 32px; height: 32px; background: #c9a84c; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; }
.badge-text { font-size: 13px; color: #e8c97a; letter-spacing: 0.05em; font-weight: 500; }

.left-title { font-size: clamp(32px, 4vw, 52px); color: #e8e4da; line-height: 1.25; font-weight: 300; margin-bottom: 16px; }
.left-title span { color: #c9a84c; font-weight: 600; }
.left-subtitle { font-size: 15px; color: rgba(232,228,218,0.5); line-height: 1.7; max-width: 420px; margin-bottom: 48px; }

.stats-row { display: flex; gap: 40px; }
.stat { border-left: 2px solid #c9a84c; padding-left: 16px; }
.stat-num { font-size: 28px; color: #e8c97a; font-weight: 600; line-height: 1; }
.stat-label { font-size: 11px; color: rgba(232,228,218,0.5); margin-top: 4px; letter-spacing: 0.05em; }

.right-panel { width: 420px; min-width: 420px; background: #0d1f3c; display: flex; flex-direction: column; position: relative; overflow: hidden; }
.right-panel::before { content: ''; position: absolute; top: -200px; right: -200px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(201,168,76,0.08) 0%, transparent 70%); pointer-events: none; }
.top-stripe { height: 3px; background: linear-gradient(90deg, transparent, #c9a84c, transparent); }

.particles { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
.particle { position: absolute; background: #c9a84c; border-radius: 50%; opacity: 0; animation: float linear infinite; }
@keyframes float {
  0%   { opacity: 0; transform: translateY(100vh) scale(0); }
  10%  { opacity: 0.6; }
  90%  { opacity: 0.3; }
  100% { opacity: 0; transform: translateY(-20px) scale(1.5); }
}

.right-inner { flex: 1; display: flex; flex-direction: column; padding: 48px 44px; position: relative; z-index: 1; }

.logo-area { margin-bottom: 40px; animation: fadeDown 0.7s ease both; }
.logo-icon { width: 52px; height: 52px; background: linear-gradient(135deg, #c9a84c, #e8c97a); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 16px; box-shadow: 0 8px 24px rgba(201,168,76,0.3); }
.logo-title { font-size: 20px; color: #e8e4da; font-weight: 600; margin-bottom: 4px; }
.logo-sub { font-size: 12px; color: rgba(232,228,218,0.5); letter-spacing: 0.05em; }

.login-card { flex: 1; display: flex; flex-direction: column; align-items: flex-start; justify-content: center; animation: fadeUp 0.8s ease 0.1s both; }
.greeting { font-size: 12px; color: #c9a84c; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 6px; font-weight: 500; }
.heading { font-size: 26px; color: #e8e4da; font-weight: 400; margin-bottom: 6px; }
.sub-heading { font-size: 13px; color: rgba(232,228,218,0.5); margin-bottom: 28px; }

.divider { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; width: 100%; }
.divider-line { flex: 1; height: 1px; background: rgba(201,168,76,0.2); }
.divider-text { font-size: 11px; color: rgba(232,228,218,0.5); letter-spacing: 0.08em; }

.status-msg { width: 100%; padding: 10px 14px; background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.2); border-radius: 8px; font-size: 13px; color: #e8c97a; margin-bottom: 16px; }

.field { margin-bottom: 16px; width: 100%; }
.field-label { display: block; font-size: 12px; color: rgba(232,228,218,0.5); letter-spacing: 0.05em; margin-bottom: 8px; }
.field-input { width: 100%; padding: 12px 16px; background: rgba(255,255,255,0.04); border: 1px solid rgba(201,168,76,0.2); border-radius: 10px; color: #e8e4da; font-size: 14px; font-family: 'Sarabun', sans-serif; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
.field-input::placeholder { color: rgba(232,228,218,0.3); }
.field-input:focus { border-color: #c9a84c; box-shadow: 0 0 0 3px rgba(201,168,76,0.15); }
.field-input--error { border-color: #e57373; }
.field-error { font-size: 11px; color: #e57373; margin-top: 6px; }
.eye-btn { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; font-size: 14px; opacity: 0.6; }
.eye-btn:hover { opacity: 1; }

.remember-row { margin-bottom: 20px; }
.remember-label { display: flex; align-items: center; gap: 8px; font-size: 13px; color: rgba(232,228,218,0.5); cursor: pointer; }
.remember-check { accent-color: #c9a84c; cursor: pointer; }

.btn-login { width: 100%; padding: 14px 24px; background: linear-gradient(135deg, #c9a84c 0%, #b8933e 100%); border: none; border-radius: 10px; color: #0a1628; font-size: 15px; font-weight: 600; font-family: 'Sarabun', sans-serif; cursor: pointer; letter-spacing: 0.02em; transition: all 0.25s ease; box-shadow: 0 4px 20px rgba(201,168,76,0.35); display: flex; align-items: center; justify-content: center; gap: 8px; }
.btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(201,168,76,0.5); }
.btn-login:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

.btn-note { font-size: 12px; color: rgba(232,228,218,0.5); margin-top: 12px; }
.btn-note span { color: #c9a84c; }

.contact-section { border-top: 1px solid rgba(201,168,76,0.2); padding-top: 24px; animation: fadeUp 0.8s ease 0.2s both; }
.contact-label { font-size: 11px; color: rgba(232,228,218,0.5); letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 14px; }
.contact-items { display: flex; flex-direction: column; gap: 10px; }
.contact-item { display: flex; align-items: center; gap: 12px; font-size: 12px; color: rgba(232,228,218,0.5); transition: color 0.2s; }
.contact-item:hover { color: #e8c97a; }
.contact-item-icon { width: 26px; height: 26px; border: 1px solid rgba(201,168,76,0.2); border-radius: 7px; display: flex; align-items: center; justify-content: center; font-size: 11px; flex-shrink: 0; }

.back-link { font-size: 12px; color: rgba(232,228,218,0.4); text-decoration: none; transition: color 0.2s; }
.back-link:hover { color: #e8c97a; }

@keyframes fadeDown { from { opacity: 0; transform: translateY(-16px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeUp   { from { opacity: 0; transform: translateY(16px);  } to { opacity: 1; transform: translateY(0); } }
@keyframes spin     { to { transform: rotate(360deg); } }
.spin { animation: spin 1s linear infinite; }

@media (max-width: 768px) { .left-panel { display: none; } .right-panel { width: 100%; min-width: unset; } }
</style>
