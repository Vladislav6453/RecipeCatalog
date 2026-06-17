# 🌿 Руководство по веткам (Branches)

## 📊 Распределение веток между участниками

### Участник A
**Модули:** Рецепты, категории, шаги приготовления, загрузка изображений

| Ветка | Описание |
|-------|---------|
| `feature/recipes-crud` | CRUD операции для рецептов |
| `feature/categories` | Управление категориями |
| `feature/recipe-steps` | Шаги приготовления |

### Участник B
**Модули:** Ингредиенты, многие-ко-многим связь, оценки, расчёт рейтинга

| Ветка | Описание |
|-------|---------|
| `feature/ingredients` | CRUD ингредиентов |
| `feature/recipe-ingredients-m2m` | Связь рецептов и ингредиентов |
| `feature/ratings` | Система оценок (1-5 звезд) |

### Участник C
**Модули:** Комментарии, избранное, каталог, UI

| Ветка | Описание |
|-------|---------|
| `feature/comments` | Система комментариев |
| `feature/favorites` | Система избранного |
| `feature/recipe-catalog-ui` | Каталог и интерфейс |

---

## 🔄 Основные ветки

| Ветка | Назначение |
|-------|-----------|
| `main` | Production (стабильный код) |
| `develop` | Development (интеграция всех feature веток) |

---

## 📝 Рабочий процесс

### 1. Создание ветки (делается один раз)
```bash
git checkout -b feature/comments
git push -u origin feature/comments
```

### 2. Каждый день - синхронизация с main
```bash
git fetch origin
git rebase origin/main
git push origin feature/comments
```

### 3. Когда модуль готов - Pull Request
```bash
# На GitHub: создать PR из feature/comments в develop
# После review и одобрения - merge
```

### 4. После merge в develop
```bash
git checkout develop
git pull origin develop
git checkout feature/comments
git rebase develop
```

---

## ✅ Статус веток

### Участник A
- [ ] `feature/recipes-crud` - В разработке
- [ ] `feature/categories` - К разработке
- [ ] `feature/recipe-steps` - К разработке

### Участник B
- [ ] `feature/ingredients` - В разработке
- [ ] `feature/recipe-ingredients-m2m` - К разработке
- [ ] `feature/ratings` - К разработке

### Участник C
- [x] `feature/comments` - ✅ Готово (merged)
- [x] `feature/favorites` - ✅ Готово (merged)
- [x] `feature/recipe-catalog-ui` - ✅ Готово (merged)

---

## 🚀 Команды для работы с ветками

### Просмотр веток
```bash
# Локальные ветки
git branch

# Все ветки (включая remote)
git branch -a

# С информацией о последнем коммите
git branch -v
```

### Переключение между ветками
```bash
# Переключиться на ветку
git checkout feature/comments

# Создать и переключиться
git checkout -b feature/my-feature

# Переключиться на main
git checkout main
```

### Обновление ветки
```bash
# Скачать обновления с GitHub
git fetch origin

# Обновить текущую ветку из main
git rebase origin/main

# Или merge (оставляет историю commits)
git merge origin/main
```

### Пушинг ветки
```bash
# Первый раз (с -u флагом)
git push -u origin feature/comments

# Следующий раз (без -u)
git push origin feature/comments

# Множество веток
git push origin feature/comments feature/favorites
```

### Удаление ветки
```bash
# Локально
git branch -d feature/comments

# На GitHub
git push origin --delete feature/comments
```

---

## 📋 Pull Request процесс

### 1. Создайте PR на GitHub
```
Title: Добавлена функциональность комментариев
Description:
- Добавлен CommentController
- Создана модель Comment
- Реализована форма комментариев
- Все тесты проходят
```

### 2. Запросите review
- Добавьте других участников как reviewers
- Дождитесь одобрения

### 3. Разрешайте конфликты
Если есть конфликты:
```bash
git fetch origin
git rebase origin/develop
# Решите конфликты в редакторе
git add .
git rebase --continue
git push origin feature/comments -f
```

### 4. Merge PR
Нажмите "Merge pull request" на GitHub

---

## 🔒 Правила работы

### ✅ Делайте
- Коммиты с понятными описаниями
- Регулярно пушьте изменения
- Синхронизируйте ветку с main перед PR
- Пишите понятный код с комментариями

### ❌ НЕ делайте
- Не пушьте напрямую в main
- Не создавайте конфликты в共用 файлах
- Не забывайте синхронизироваться
- Не пушьте непроверенный код

---

## 📊 Текущий статус

```
main
├── feature/comments ✅ MERGED
├── feature/favorites ✅ MERGED
├── feature/recipe-catalog-ui ✅ MERGED
├── feature/recipes-crud 🔄 IN PROGRESS (Participant A)
├── feature/categories 📋 PENDING (Participant A)
├── feature/recipe-steps 📋 PENDING (Participant A)
├── feature/ingredients 🔄 IN PROGRESS (Participant B)
├── feature/recipe-ingredients-m2m 📋 PENDING (Participant B)
└── feature/ratings 📋 PENDING (Participant B)
```

---

## 💡 Советы

1. **Часто коммитьте** - маленькие, понятные коммиты лучше
2. **Регулярно пушьте** - не теряйте данные
3. **Описывайте изменения** - помогает другим понять что вы делаете
4. **Реагируйте на review** - код review - это нормально
5. **Тестируйте перед PR** - убедитесь что всё работает

---

## 🆘 Помощь

### Если что-то пошло не так:
1. Остановитесь и спросите
2. Не паниковать - это обратимо
3. Используйте `git reflog` для восстановления
4. Если совсем плохо - переклонируйте репо

### Полезные команды для помощи:
```bash
# Показать историю commits
git log --oneline

# Отменить последний commit (локально)
git reset --soft HEAD~1

# Посмотреть кто менял файл
git blame file.php

# Показать различия между ветками
git diff feature/comments main
```

---

**Удачи в разработке! 🚀**
