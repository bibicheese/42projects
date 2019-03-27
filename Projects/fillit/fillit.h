/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.h                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/23 19:03:43 by jmondino          #+#    #+#             */
/*   Updated: 2019/02/20 17:13:01 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FILLIT_H
# define FILLIT_H

# define BUFF_SIZE 1000

# include <sys/types.h>
# include <sys/wait.h>
# include <sys/stat.h>
# include <fcntl.h>
# include <string.h>
# include <stdlib.h>
# include <unistd.h>

typedef struct		s_ttrm
{
	int				x1;
	int				x2;
	int				x3;
	int				x4;
	char			letter;
	int				j;
	int				v_line;
}					t_trm;

/*
** functions.c
*/

void				*ft_memalloc(size_t size);
void				ft_memdel(void **ap);
void				ft_putchar(char c);
void				ft_putstr(const char *s);
char				*ft_strcat(char *s1, const char *s2);

/*
** functions2.c
*/

char				*ft_strjoin(char const *s1, char const *s2);
size_t				ft_strlen(const char *s);
char				*ft_strncat(char *s1, const char *s2, size_t n);
char				*ft_strnew(size_t size);
char				*ft_strfchr(char *s, int c);

/*
** functions3.c
*/

char				*ft_strdup(const char *s1);
int					ft_iscinstr(char *str, char c);
void				ft_bzero(void *s, size_t n);
char				*ft_strchr(const char *s, int c);

/*
** get_next_line.c
*/

int					get_next_line(const int fd, char **line);

/*
** backtraking.c
*/

void				erase_ttrm(t_trm tet, char *str);
int					backtrack(t_trm *tet, char *str, int i);
int					ttrm_try(char *str, t_trm *tet, int i);
int					place_ttrm(t_trm *tet, char *str, int i);

/*
** place_ttrm.c
*/

char				*create_str(int	v_line);
void				print_str(char *str, int v_line);
int					strmerge(char *str, t_trm tet, int v_line);

/*
** create_ttrm.c
*/

t_trm				create(char *str, int number);
char				*str_move(char *str, int v_line);
char				*str_trim(char *str, int v_line);
t_trm				*ttrm_edit(char *str, int v_line, int i);

/*
** adaptation.c
*/

void				upgrade_ttrm(t_trm *tet, int v_line);
void				first_upgrade(t_trm *tet, int v_line);
int					downgrade_ttrm(t_trm *tet, int v_line);
int					check_upgrade(char *str, t_trm tet, int v_line);
int					check_downgrade(t_trm tet);

/*
**	misc.c
*/

int					min_v_line(char *str);
int					count_one(char *str);
int					count_line(char *str, int i);
int					count_col(char *str, int i);
int					check_except(char *str, int i);

/*
** check.c
*/

int					ft_check(char *line, int count);
void				ft_checkline(char *line);
void				ft_stockline(char *line);
void				ft_nbpieces(char *stock);

/*
** checkform.c
*/

void				ft_checkform(char *stock);
int					ft_checkside(char *tetri, int i, int count);
char				*ft_stockalltetris(char *ligne);
void				ft_error(int ac);
void				ft_checklastline(char *line, int ac);

/*
** main.c
*/

void				ft_read(int fd, char **tetris);

#endif
