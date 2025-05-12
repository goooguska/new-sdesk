#!/bin/bash

DIR="${1:-.}"
EXT="${2:-php}"
OUTFILE="${3:-all_code.txt}"

if [ ! -d "$DIR" ]; then
  echo "Error: directory '$DIR' not exist."
  exit 1
fi

> "$OUTFILE"

find "$DIR" -type f -name "*.${EXT}" | while read file; do
  echo -e "\n\n $(basename "$file") \n" >> "$OUTFILE"
  cat "$file" >> "$OUTFILE"
done

echo "Files with extensions .$EXT from '$DIR' combine in: $OUTFILE"
