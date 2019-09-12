# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile                                           :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: jmondino <marvin@42.fr>                    +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2019/09/12 19:08:32 by jmondino          #+#    #+#              #
#    Updated: 2019/09/12 19:08:32 by jmondino         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #


NAME = minishell

SRC = src/builtin.c src/command.c src/init.c src/launch.c src/main.c 

FLAGS = -Wextra -Wall -Werror

ifndef VERBOSE
.SILENT:
endif

all:$(NAME)

$(NAME): $(SRC)
	make -C libft
	gcc $(FLAGS) -o $(NAME) $(SRC) libft/libft.a
	echo "\033[32m$(NAME) compiled.\033[0m"

clean:
	make -C libft clean
	echo "\033[32mObjects files deleted.\033[0m"

fclean: clean
	make -C libft fclean
	rm -f minishell

re: fclean all
