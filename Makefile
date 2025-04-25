.PHONY: run-dev

PHP = php
COMPOSER = composer
MANAGE = $(COMPOSER)

run-dev:
	$(MANAGE) run dev

