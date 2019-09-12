/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   minishell.h                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/07/11 11:24:22 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/12 19:08:21 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef MINISHELL_H
# define MINISHELL_H

# include <stdio.h>
# include <stdlib.h>
# include <unistd.h>
# include "../libft/libft.h"

typedef struct			s_shell
{
	int					error;
	char				**env;
	char				**paths;
}						t_shell;

void	launch(char **args, t_shell *shell);
void	prompt(t_shell *shell);
char	**array_cpy(char **src);
char	*find_cmd(t_shell *shell, char *cmd);
t_shell	*init_shell(void);
char	**paths(char **env);
int		builtin(char **args);

#endif
