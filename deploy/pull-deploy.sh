#!/usr/bin/env bash
set -euo pipefail

REPO_DIR="${REPO_DIR:-/opt/coolify-source/millisfera-az}"
BRANCH="${BRANCH:-main}"
REMOTE="${REMOTE:-origin}"
SSH_KEY="${SSH_KEY:-/root/.ssh/millisfera_github_ed25519}"
WARM_HOST="${WARM_HOST:-millisfera.az}"
WARM_URL="${WARM_URL:-https://millisfera.az}"
LOCAL_RESOLVE_IP="${LOCAL_RESOLVE_IP:-127.0.0.1}"

cd "$REPO_DIR"

export GIT_SSH_COMMAND="ssh -i ${SSH_KEY} -o IdentitiesOnly=yes -o StrictHostKeyChecking=no"

git fetch "$REMOTE" "$BRANCH"
local_rev="$(git rev-parse HEAD)"
remote_rev="$(git rev-parse "$REMOTE/$BRANCH")"

if [ "$local_rev" = "$remote_rev" ]; then
  echo "Millisfera is already up to date: $(git rev-parse --short HEAD)"
  exit 0
fi

git reset --hard "$REMOTE/$BRANCH"

curl -ksS --resolve "${WARM_HOST}:443:${LOCAL_RESOLVE_IP}" "$WARM_URL" >/dev/null || true

echo "Millisfera synced to $(git rev-parse --short HEAD)"
