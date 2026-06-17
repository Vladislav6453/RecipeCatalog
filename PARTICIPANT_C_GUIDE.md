# 👤 Инструкция для участника С

## 📋 Ваши задачи

Вы отвечаете за:
1. **Комментарии** (feature/comments)
2. **Избранное** (feature/favorites)
3. **Каталог и UI** (feature/recipe-catalog-ui)

---

## 🚀 Начало работы

### Шаг 1: Клонируйте репозиторий
```bash
git clone https://github.com/USERNAME/RecipeCatalog.git
cd RecipeCatalog
```

### Шаг 2: Переключитесь на вашу ветку
```bash
git checkout feature/comments
```

Или переключайтесь между своими ветками:
```bash
git checkout feature/favorites
git checkout feature/recipe-catalog-ui
```

### Шаг 3: Установите зависимости
```bash
composer install
npm install
```

### Шаг 4: Настройте окружение
```bash
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed
```

### Шаг 5: Запустите приложение
```bash
php artisan serve
```

---

## 📂 Файлы, которые вы создали/редактировали

### 1. Комментарии (feature/comments)
- ✅ `app/Http/Controllers/CommentController.php` - Контроллер
- ✅ `app/Models/Comment.php` - Модель
- ✅ `resources/views/components/comment-form.blade.php` - Форма
- ✅ `database/factories/CommentFactory.php` - Фабрика

**Функциональность:**
- Добавление комментариев к рецептам
- Удаление комментариев
- Отображение комментариев с автором и временем

### 2. Избранное (feature/favorites)
- ✅ `app/Http/Controllers/FavoriteController.php` - Контроллер
- ✅ `app/Models/Favorite.php` - Модель
- ✅ `resources/views/favorites/index.blade.php` - Страница избранного
- ✅ `database/factories/FavoriteFactory.php` - Фабрика

**Функциональность:**
- Добавление/удаление из избранного
- Список избранных рецептов
- Статистика избранного в дашборде

### 3. Каталог и UI (feature/recipe-catalog-ui)
- ✅ `app/Http/Controllers/RecipeController.php` - Контроллер каталога
- ✅ `resources/views/recipes/index.blade.php` - Каталог рецептов
- ✅ `resources/views/recipes/show.blade.php` - Страница рецепта
- ✅ `resources/views/home.blade.php` - Главная страница
- ✅ `resources/views/components/recipe-card.blade.php` - Карточка рецепта
- ✅ `resources/views/components/recipe-filters.blade.php` - Фильтры
- ✅ `resources/css/app.css` - Стили

**Функциональность:**
- Отображение каталога рецептов
- Поиск и фильтрация
- Сортировка
- Детальная страница рецепта
- Красивый UI с Tailwind CSS

---

## 💻 Работа с кодом

### Каждый раз, когда начинаете работу:
```bash
# Убедитесь, что на правильной ветке
git branch

# Обновите ветку из main
git fetch origin
git rebase origin/main

# Начните работу
```

### Когда закончите с задачей:
```bash
# Добавьте все файлы
git add .

# Создайте коммит с описанием
git commit -m "Добавлена функциональность комментариев"

# Пусли на GitHub
git push origin feature/comments
```

### Создайте Pull Request:
1. Откройте GitHub
2. Нажмите "Compare & pull request"
3. Напишите описание изменений
4. Попросите review

---

## 📝 Примеры кода

### Комментарии - Контроллер
```php
// app/Http/Controllers/CommentController.php
public function store(Request $request, Recipe $recipe)
{
    $request->validate([
        'content' => 'required|string|max:1000'
    ]);

    $recipe->comments()->create([
        'user_id' => auth()->id(),
        'content' => $request->content
    ]);

    return back()->with('success', 'Комментарий добавлен!');
}
```

### Избранное - Контроллер
```php
// app/Http/Controllers/FavoriteController.php
public function toggle(Recipe $recipe)
{
    $favorite = Favorite::where('user_id', auth()->id())
        ->where('recipe_id', $recipe->id)
        ->first();

    if ($favorite) {
        $favorite->delete();
    } else {
        Favorite::create([
            'user_id' => auth()->id(),
            'recipe_id' => $recipe->id,
        ]);
    }
}
```

### Каталог - Контроллер
```php
// app/Http/Controllers/RecipeController.php
public function index(Request $request)
{
    $query = Recipe::with(['category', 'author'])
        ->where('is_published', true)
        ->latest();

    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    return view('recipes.index', [
        'recipes' => $query->paginate(12)
    ]);
}
```

---

## 🔍 Тестирование

### Локально
```bash
php artisan serve
# Откройте http://localhost:8000
```

### Попробуйте функции:
1. **Комментарии**: Перейдите на рецепт, добавьте комментарий
2. **Избранное**: Нажмите ❤️ на рецепте
3. **Каталог**: Используйте фильтры и поиск

---

## 🐛 Проблемы и решения

### "Class not found"
```bash
composer dump-autoload
php artisan cache:clear
```

### "Database error"
```bash
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

### Конфликты при merge
```bash
git pull origin main
# Решите конфликты в редакторе
git add .
git commit -m "Resolved conflicts"
git push origin feature/comments
```

---

## 📚 Полезные ссылки

- **Laravel документация**: https://laravel.com/docs
- **Blade шаблоны**: https://laravel.com/docs/blade
- **Tailwind CSS**: https://tailwindcss.com/docs
- **Eloquent ORM**: https://laravel.com/docs/eloquent

---

## 📞 Коммуникация

- Если есть вопросы - создавайте Issues на GitHub
- Для синхронизации - используйте Pull Requests
- Описывайте свои изменения в commit messages

---

## ✅ Чек-лист перед push

- [ ] Код работает локально
- [ ] Нет ошибок в консоли
- [ ] Все тесты проходят (если есть)
- [ ] Добавлены комментарии в коде
- [ ] Коммит message описывает изменения
- [ ] Вы на правильной ветке (feature/...)

---

**Успехов в разработке! 🚀**

Если что-то непонятно - спрашивайте!
