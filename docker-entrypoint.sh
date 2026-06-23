#!/bin/bash
set -e

# Disable all conflicting Apache MPM modules
# Railway can sometimes load extra MPMs at startup, so force only prefork.
a2dismod mpm_event 2>/dev/null || true
a2dismod mpm_worker 2>/dev/null || true
a2dismod mpm_prefork 2>/dev/null || true

a2enmod mpm_prefork rewrite

exec apache2-foreground
