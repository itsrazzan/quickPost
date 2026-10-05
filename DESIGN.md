# DESIGN.md — QuickPost

Design direction for everything QuickPost renders. The antislop skills read this
file as design data; AGENTS.md remains the agent routing file.

## Status
Learning project: the interface exists, the publishing does not. Copy admits this
plainly (the About FAQ is the register to match). Previews are labeled as
previews, and unbuilt features appear as "(soon)" text, never as buttons.

## Voice
Plain, specific, unhyped. Short sentences. No buzzwords ("seamless", "AI-powered"),
no invented numbers, no em dashes. If a fact is not real, it is not shown.

## Color
- Canvas: neutral-100 (#f5f5f5). Surfaces: white. Text: neutral-800/neutral-900.
- One accent, orange-600 (#ea580c): logo mark, active-link underline, focus rings.
  Text hover uses orange-700 (#c2410c, 4.75:1 on neutral-100, computed).
- Why: a warm, tool-like accent chosen on purpose, and deliberately not the
  blue-purple default. Everything else stays neutral so the accent lands only
  where attention belongs.

## Type
Instrument Sans for everything. Bold, tight-tracked headings; sentence case only;
no uppercase tracked labels, no monospace-as-aesthetic. Chosen over the Inter
default for its slightly warmer, rounder voice.

## Mark
A clock in the accent square. The product is about when posts go out; the earlier
lightning bolt was generic decoration (antislop R-04) and was replaced.

## Elevation
Flat by default. Exactly one thing lifts: the interface preview on the home page,
because it is the product artifact and the focal point. The floating navbar
separates with a 1px border plus glass, not a shadow; cards and panels get 1px
neutral-200 borders; buttons carry at most a small interaction shadow.

## Glass
The sticky navbar is the only frosted surface (bg-white/90 + backdrop-blur). Kept
because the nav floats over scrolling content and must stay legible over both the
canvas and cards. Nothing else gets blur (antislop R-10 dose cap).

## Motion
Hover and active feedback only, 150ms: a small lift on buttons, a rotate on the
FAQ chevron. No loops, no scroll choreography. MOTION 1.

## Dials
ENERGY 1 / RHYTHM 2 / MOTION 1
Calm tool energy; sections vary in composition but share one visual system;
motion is feedback, not decoration.

## Contrast rules
Computed, not eyeballed: text at least 4.5:1, component boundaries at least 3:1.
Verified pairs: white on neutral-900 12.6+, neutral-500 on white 4.74, neutral-600
on neutral-100 7.18, accent-strong on neutral-100 4.75, accent focus ring on white
3.56 (all 2-decimal computations against WCAG 2.x relative luminance).
