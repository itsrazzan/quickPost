# DESIGN.md — QuickPost

Design direction for everything QuickPost renders. The antislop skills read this
file as design data; AGENTS.md remains the agent routing file.

The layout, type, and motion system is adapted from sumopod.com (analyzed
October 2026): pill vocabulary, framed hero, alternating feature rows, soft
small shadows, and a signature motion set. The brand stays QuickPost: one warm
orange accent on a neutral canvas, honest copy, no invented facts.

## Status
Learning project: the interface exists, the publishing does not. Copy admits this
plainly (the About FAQ is the register to match). Previews are labeled as
previews, and unbuilt features appear as "(soon)" text, never as dead buttons.
Platform lists say "planned", because nothing is published anywhere yet.

## Voice
Plain, specific, unhyped. Short sentences. No buzzwords ("seamless", "AI-powered"),
no invented numbers, no em dashes. If a fact is not real, it is not shown.
We borrow sumopod's style, never its copy.

## Color
- Canvas: white. Surfaces: white cards on white, separated by hairlines. Panels
  may sit on accent-pale or neutral-50 tints. Text: neutral-800/neutral-900.
- One accent, orange-600 (#ea580c): buttons, logo mark, active-link underline,
  badges, focus rings. Hover/darker surface: orange-700 (#c2410c). Tints:
  orange-100 (#ffedd5, hairlines and soft borders) and orange-50 (#fff7ed,
  badge fills).
- Contrast is computed, not eyeballed. Orange-600 on white is 3.93:1: legal for
  large text and UI components only. Small accent text uses orange-700
  (4.73:1). White text on orange-600 is 3.37:1, so primary buttons are
  orange-700 with white text (4.73:1), hovering to orange-800. Everything else
  stays neutral so the accent lands only where attention belongs.
- The deep CTA panel uses orange-700 (#c2410c), mirroring sumopod's
  brand-dark panel, with white headings (contrast 4.5+ at heading sizes).

## Type
Inter for body and UI. Funnel Display for headings and display text; the hero
h1 is weight 300 (light), section h2s 500–600. All type negative-tracked:
headings -0.02em to -0.05em, body about -0.01em. Sentence case only; no
uppercase tracked labels, no monospace-as-aesthetic. Both load through the
Vite Bunny Fonts plugin, display-swap.

## Mark
A clock in the accent square. The product is about when posts go out. The mark
is identical in header and footer (the footer's old lightning bolt was generic
decoration and was replaced).

## Elevation
Soft, small, black, never colored. The nav pill floats on
`0 10px 30px rgba(17,24,39,0.10)`; the hero frame and floating chips carry
similar single-digit-alpha black shadows; cards are flat with hairline borders
until hovered. Nothing gets large or layered shadows.

## Shape
Pill vocabulary: every button, badge, and nav chip is rounded-full. Big
containers are rounded-2xl to rounded-3xl (16–24px). Hairline dividers are
neutral-200, or accent-soft where a brand-tinted edge is wanted.

## Motion
Signature set, all gated behind `prefers-reduced-motion: reduce` (which
disables every reveal, loop, and marquee):
- Hero headline reveals per word: clip-path rise, 65ms, 55ms stagger per word.
- Scroll reveals: elements with `data-reveal` fade in and rise 18px, 0.7s,
  triggered once by IntersectionObserver.
- Floating chips bob ±7px on a 3.6s loop with negative stagger delays.
- Marquees translate one copy width on a 30–40s linear loop behind an
  edge-fade mask.
- Pressable: interactive elements respond in 150ms and scale to 0.96 on
  :active.
Motion is feedback and delight around real content, never decoration on
empty space.

## Layout
Container: `max-w-7xl` (1280px) with `px-5 sm:px-8`. Hero content centers
around max-w-3xl. Feature rows alternate two columns on lg and stack below.
Sections breathe with mt-24-ish rhythm. Every page is expected to work at
375px, 768px, and 1280px.

## Glass
The sticky navbar is the only frosted surface (bg-white/90 + backdrop-blur),
because it floats over scrolling content. Nothing else gets blur.

## Dials
ENERGY 2 / RHYTHM 2 / MOTION 3
Warmer and more alive than the old calm-tool setting, but still one visual
system: loops exist only where the design says so (hero chips, marquee).
